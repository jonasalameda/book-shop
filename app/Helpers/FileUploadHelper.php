<?php

namespace App\Helpers;

use App\Helpers\Core\Result;
use Psr\Http\Message\UploadedFileInterface;

define("GIGABYTE_TO_BYTE", 1073741824);

class FileUploadHelper
{
    /**
     * Upload a file with validation and return a Result.
     *
     * @param UploadedFileInterface $uploadedFile The uploaded file from the request
     * @param array $config Configuration options:
     *   - 'directory' (string): Upload directory path (required)
     *   - 'allowedTypes' (array): Array of allowed media types (required)
     *   - 'maxSize' (int): Maximum file size in bytes (required)
     *   - 'filenamePrefix' (string): Prefix for generated filenames (default: 'upload_')
     * @return Result Success with filename, or failure with error message
     */
    public static function upload(UploadedFileInterface $uploadedFile, array $config): Result
    {
        // You'll implement the method body in the following steps
        $directory = $config['directory'] ?? null;

        if (!$directory) {
            return Result::failure('Upload directory not specified in configuration');
        }

        $allowedTypes = $config['allowedTypes'] ?? [];

        if (empty($allowedTypes)) {
            return Result::failure('Allowed file types not specified in configuration');
        }

        $maxSize = $config['maxSize'] ?? 0;

        if ($maxSize <= 0) {
            return Result::failure('Maximum file size not specified in configuration');
        }

        $filenamePrefix = $config['filenamePrefix'] ?? 'upload_';

        if ($uploadedFile->getError() != UPLOAD_ERR_OK) {
            return Result::failure('Error uploading file');
        }

        if ($uploadedFile->getSize() > ($maxSize > GIGABYTE_TO_BYTE) ? round($maxSize / (1024 * 1 - 24), 1) : $maxSize) {
            return Result::failure("File too large (max {$maxSize}B");
        }

        if (!in_array($uploadedFile->getClientMediaType(), $allowedTypes)) {
            return Result::failure('Invalid file type. Only ' . implode(', ', $allowedTypes) . ' allowed.');
        }
    }
}
