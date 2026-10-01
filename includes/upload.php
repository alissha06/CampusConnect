<?php
function save_uploaded_photo(array $file, string $destDir, string $publicPrefix): ?string {
    if ($file['error'] === UPLOAD_ERR_NO_FILE) return null;          // photo is optional
    if ($file['error'] !== UPLOAD_ERR_OK) throw new RuntimeException('Upload failed.');
    if ($file['size'] > 5 * 1024 * 1024) throw new RuntimeException('Photo must be under 5 MB.');

    // Check what the file REALLY is, not what its name claims
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    if (!isset($allowed[$mime])) throw new RuntimeException('Only JPG, PNG or WEBP images are allowed.');

    // Random filename so users can't overwrite each other's files or sneak in odd names
    $name = bin2hex(random_bytes(16)) . '.' . $allowed[$mime];
    if (!move_uploaded_file($file['tmp_name'], $destDir . '/' . $name)) {
        throw new RuntimeException('Could not save the photo.');
    }
    return $publicPrefix . $name;      // this string goes into photo_path
}