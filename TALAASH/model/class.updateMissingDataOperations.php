<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Function to handle adding data through form
class UpdateMissingPersonDatabse
{
    public function addDataThroughForm($postData, $fileData)
    {
        // Get and sanitize form data
        $fname = htmlspecialchars($postData['first_name']);
        $lname = htmlspecialchars($postData['last_name']);
        $name = $fname . ' ' . $lname;
        $address = htmlspecialchars($postData['address']);
        $pincode = htmlspecialchars($postData['pincode']);
        $mark = htmlspecialchars($postData['mark']);
        $age = htmlspecialchars($postData['age']);
        $fir_number = htmlspecialchars($postData['FIR_number']);
        $contact_details = htmlspecialchars($postData['contact_details']);

        // Handle file upload
        if (!isset($fileData['photo_url']) || $fileData['photo_url']['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => 'File upload error or file not uploaded'];
        }

        $photo_url = $fileData['photo_url']['name'];
        $target_dir = BASE_FILE_PATH . "media/images/user/";
        $target_file = $target_dir . basename($photo_url);

        // Check if directory exists and is writable
        if (!is_dir($target_dir)) {
            return ['success' => false, 'message' => 'Upload directory is not writable'];
        }

        // Move the uploaded file
        if (!move_uploaded_file($fileData['photo_url']['tmp_name'], $target_file)) {
            return ['success' => false, 'message' => 'Failed to move uploaded file'];
        }

        // Load existing data
        $json_file = BASE_FILE_PATH . "media/data/reports.json";
        if (file_exists($json_file)) {
            $data = json_decode(file_get_contents($json_file), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return ['success' => false, 'message' => 'Error reading JSON file'];
            }
        } else {
            $data = [];
        }

        // Add new record
        $data[] = [
            'name' => $name,
            'address' => $address,
            'pincode' => $pincode,
            'mark' => $mark,
            'age' => $age,
            'FIR_number' => $fir_number,
            'metadata' => [
                'contact_details' => $contact_details
            ],
            'photo_url' => $photo_url,
            'isFound' => false,
            'isDeleted' => false,
        ];

        // Save updated data
        if (file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT)) === false) {
            return ['success' => false, 'message' => 'Failed to save data to JSON file'];
        }

        return ['success' => true, 'message' => 'Data saved successfully'];
    }

    public function importDataFromJson($file)
    {
        $response = ['success' => false, 'message' => 'An error occurred'];

        // Check if file is a valid JSON file
        $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
        if ($fileType !== 'json') {
            $response['message'] = 'Invalid file type. Please upload a JSON file.';
            return $response;
        }

        // Read and decode JSON file
        $fileContent = file_get_contents($file['tmp_name']);
        $data = json_decode($fileContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $response['message'] = 'Error decoding JSON file.';
            return $response;
        }

        // Validate data structure
        if (!is_array($data)) {
            $response['message'] = 'Invalid data format.';
            return $response;
        }

        // Process and update records in the database
        foreach ($data as $record) {
            $result = $this->processRecord($record);

            if (!$result['success']) {
                $response['message'] = $result['message'];
                return $response;
            }
        }

        $response['success'] = true;
        $response['message'] = 'Data imported successfully.';
        return $response;
    }

    private function processRecord($record)
    {
        $response = ['success' => false, 'message' => 'An error occurred'];

        // Path to the reports.json file
        $json_file = BASE_FILE_PATH . 'media/data/reports.json';

        // Read the existing data from reports.json
        if (file_exists($json_file)) {
            $existingData = json_decode(file_get_contents($json_file), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $response['message'] = 'Error decoding existing JSON file.';
                return $response;
            }
        } else {
            $existingData = [];
        }

        // Validate record data
        if (isset($record['name'], $record['address'],$record['pincode'], $record['mark'], $record['age'], $record['FIR_number'], $record['metadata']['contact_details'], $record['photo_url'])) {
            // Append new record to existing data
            $existingData[] = [
                'name' => htmlspecialchars($record['name']),
                'address' => htmlspecialchars($record['address']),
                'pincode' => htmlspecialchars($record['pincode']),
                'mark' => htmlspecialchars($record['mark']),
                'age' => htmlspecialchars($record['age']),
                'FIR_number' => htmlspecialchars($record['FIR_number']),
                'metadata' => [
                    'contact_details' => htmlspecialchars($record['metadata']['contact_details'])
                ],
                'photo_url' => htmlspecialchars($record['photo_url'])
            ];

            // Save updated data back to reports.json
            if (file_put_contents($json_file, json_encode($existingData, JSON_PRETTY_PRINT))) {
                $response['success'] = true;
                $response['message'] = 'Record added successfully.';
            } else {
                $response['message'] = 'Failed to save updated data.';
            }
        } else {
            $response['message'] = 'Invalid record data.';
        }

        return $response;
    }

    public function markAsFound($fir_number)
    {
        // Path to the reports.json file
        $json_file = BASE_FILE_PATH . 'media/data/reports.json';

        // Check if the file exists
        if (!file_exists($json_file)) {
            return ['success' => false, 'message' => 'Reports file not found.'];
        }

        // Read the existing data from reports.json
        $data = json_decode(file_get_contents($json_file), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['success' => false, 'message' => 'Error decoding JSON data.'];
        }

        $isUpdated = false; // To track if any record was updated

        // Iterate through each record in the data
        foreach ($data as &$record) {
            // Check if the FIR_number matches
            if (isset($record['FIR_number']) && $record['FIR_number'] === $fir_number) {
                // Set the isFound field to true
                $record['isFound'] = true;
                $isUpdated = true;
            }
        }

        // If no record was updated, return a failure message
        if (!$isUpdated) {
            return ['success' => false, 'message' => 'No record found with the given FIR number.'];
        }

        // Save the updated data back to reports.json
        if (file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT)) === false) {
            return ['success' => false, 'message' => 'Failed to update the JSON file.'];
        }

        // Return success message if the update was successful
        return ['success' => true, 'message' => 'Record updated successfully.'];
    }

    public function markAsDelete($fir_number)
    {
        // Path to the reports.json file
        $json_file = BASE_FILE_PATH . 'media/data/reports.json';

        // Check if the file exists
        if (!file_exists($json_file)) {
            return ['success' => false, 'message' => 'Reports file not found.'];
        }

        // Read the existing data from reports.json
        $data = json_decode(file_get_contents($json_file), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['success' => false, 'message' => 'Error decoding JSON data.'];
        }

        $isDeleted = false; // To track if any record was updated

        // Iterate through each record in the data
        foreach ($data as &$record) {
            // Check if the FIR_number matches
            if (isset($record['FIR_number']) && $record['FIR_number'] === $fir_number) {
                // Set the isFound field to true
                $record['isDeleted'] = true;
                $isDeleted = true;
            }
        }

        // If no record was updated, return a failure message
        if (!$isDeleted) {
            return ['success' => false, 'message' => 'No record found with the given FIR number.'];
        }

        // Save the updated data back to reports.json
        if (file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT)) === false) {
            return ['success' => false, 'message' => 'Failed to update the JSON file.'];
        }

        // Return success message if the update was successful
        return ['success' => true, 'message' => 'Record updated successfully.'];
    }

}
?>