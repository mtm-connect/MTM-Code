<?php

namespace App\Support;

class PdfAsset
{
    /**
     * Return absolute filesystem path for a public/ relative path.
     * Example: "images/jacket_type/x.png" -> "/.../public/images/jacket_type/x.png"
     */
    public static function path(string $relative): ?string
    {
        $abs = public_path($relative);
        return ($abs && file_exists($abs)) ? $abs : null;
    }

    /**
     * Resolve an image from a value→filename map under /public/images/{folder}/...
     * Accepts BOTH signatures:
     *   fromMap(array $map, ?string $selected, string $folder)           // (original)
     *   fromMap(string $folder, array $map, ?string $selected)           // (blade-friendly)
     */
    public static function fromMap($a, $b, $c, string $fallback = 'images/order/default.jpg'): ?string
    {
        // Normalize args
        if (is_string($a) && is_array($b)) {
            // folder, map, selected
            $folder   = $a;
            $map      = $b;
            $selected = $c;
        } else {
            // map, selected, folder
            $map      = $a;
            $selected = $b;
            $folder   = $c;
        }

        $file = ($selected !== null && array_key_exists($selected, $map)) ? ($map[$selected] ?? null) : null;

        if ($file) {
            $abs = public_path("images/{$folder}/{$file}");
            if (is_string($abs) && file_exists($abs)) {
                return $abs;
            }
        }

        $fallbackAbs = public_path($fallback);
        return file_exists($fallbackAbs) ? $fallbackAbs : null;
    }

    /**
     * Smarter resolver that tolerates small key differences.
     * Tries exact, then case-insensitive, then a trimmed/condensed lookup.
     */
    public static function fromMapSmart(string $folder, array $map, ?string $selected, string $fallback = 'images/order/default.jpg'): ?string
    {
        if ($selected === null || $selected === '') {
            return self::path($fallback);
        }

        // 1) exact
        if (array_key_exists($selected, $map)) {
            $abs = public_path("images/{$folder}/{$map[$selected]}");
            if (file_exists($abs)) return $abs;
        }

        // 2) case-insensitive
        foreach ($map as $k => $v) {
            if (mb_strtolower((string)$k) === mb_strtolower((string)$selected)) {
                $abs = public_path("images/{$folder}/{$v}");
                if (file_exists($abs)) return $abs;
            }
        }

        // 3) normalised (collapse spaces, remove quotes)
        $norm = static function ($s) {
            $s = str_replace(['"', "'"], '', (string)$s);
            $s = preg_replace('/\s+/', ' ', trim($s));
            return mb_strtolower($s);
        };
        $needle = $norm($selected);
        foreach ($map as $k => $v) {
            if ($norm($k) === $needle) {
                $abs = public_path("images/{$folder}/{$v}");
                if (file_exists($abs)) return $abs;
            }
        }

        // fallback
        $fallbackAbs = public_path($fallback);
        return file_exists($fallbackAbs) ? $fallbackAbs : null;
    }

    /**
     * Convert a local absolute file path to a data URI for Dompdf <img src="...">
     */
    public static function toDataUri(?string $absPath): ?string
    {
        if (!$absPath || !file_exists($absPath)) return null;
        $ext = strtolower(pathinfo($absPath, PATHINFO_EXTENSION));
        $mime = match ($ext) {
            'png'  => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'gif'  => 'image/gif',
            'svg'  => 'image/svg+xml',
            default => null,
        };
        if (!$mime) return null;

        $data = @file_get_contents($absPath);
        if ($data === false) return null;

        return 'data:' . $mime . ';base64,' . base64_encode($data);
        // (no filename=...; Dompdf just needs a valid image data URI)
    }

    /**
     * 1×1 transparent PNG as a data URI (handy fallback)
     */
    public static function transparentPixel(): string
    {
        return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGMAAQAABQABDQottAAAAABJRU5ErkJggg==';
    }

    /**
     * If given a path, return structured debug info array for Blade.
     * If no arg is given, retain backward-compatible simple string.
     */
    public static function debugInfo(?string $absPath = null)
    {
        if ($absPath === null) return 'PdfAsset OK';
        $exists = file_exists($absPath);
        return [
            'path'   => $absPath,
            'exists' => $exists,
            'size'   => $exists ? filesize($absPath) : null,
            'ext'    => pathinfo((string)$absPath, PATHINFO_EXTENSION),
        ];
    }
}

