<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first() ?? new Setting();
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first() ?? new Setting();

        if ($request->filled('video')) {
            $setting->video = 'settings/video/' . $request->input('video');
        }

        if ($request->filled('audio')) {
            $setting->audio = 'settings/audio/' . $request->input('audio');
        }

        $setting->save();

        return response()->json(['message' => 'تم التحديث بنجاح']);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'chunk' => 'required|file',
            'chunk_number' => 'required|integer',
            'total_chunks' => 'required|integer',
            'upload_id' => 'required|string',
            'file_name' => 'required|string',
            'type' => 'required|in:video,audio',
        ]);

        $tempDir = storage_path("app/chunks/{$request->upload_id}");
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $chunkPath = $tempDir . "/chunk_{$request->chunk_number}";
        file_put_contents($chunkPath, file_get_contents($request->file('chunk')->getRealPath()));

        // ✅ عند رفع آخر جزء، ندمج الملف كامل
        if ((int)$request->chunk_number === (int)$request->total_chunks) {
            $finalFileName = $request->upload_id . '__' . $request->file_name;
            $finalPath = storage_path('app/public/settings/' . $request->type . '/' . $finalFileName);

            $finalDir = dirname($finalPath);
            if (!is_dir($finalDir)) {
                mkdir($finalDir, 0777, true);
            }

            $output = fopen($finalPath, 'ab');

            for ($i = 1; $i <= $request->total_chunks; $i++) {
                $chunkFile = $tempDir . "/chunk_{$i}";
                if (file_exists($chunkFile)) {
                    $input = fopen($chunkFile, 'rb');
                    stream_copy_to_stream($input, $output);
                    fclose($input);
                    unlink($chunkFile);
                } else {
                    Log::error("❌ Missing chunk file: {$chunkFile}");
                    fclose($output);
                    return response()->json(['error' => 'جزء مفقود من الملف'], 500);
                }
            }

            fclose($output);
            rmdir($tempDir);

            Log::info("✅ File merged successfully: " . $finalPath);
        }

        return response()->json(['status' => 'ok']);
    }

    public function deleteMedia(Request $request)
    {
        $request->validate([
            'type' => 'required|in:video,audio',
        ]);

        $setting = Setting::first();

        if (!$setting) {
            return redirect()->back()->with('error', 'لم يتم العثور على الإعدادات');
        }

        $type = $request->type;
        $filePath = $setting->$type;

        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            $setting->$type = null;
            $setting->save();
        }

        return redirect()->back()->with('success', '✔ تم حذف ' . ($type == 'video' ? 'الفيديو' : 'الصوت'));
    }
}
