<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Opis\JsonSchema\Validator;

function validate_profile_json($profileData) {
    // Trim all input values to remove leading/trailing spaces
    $profileData['FullName'] = trim($profileData['FullName']);
    $profileData['Email'] = trim($profileData['Email']);
    $profileData['PhoneNumber'] = trim($profileData['PhoneNumber']);
    $profileData['Qualifications'] = trim($profileData['Qualifications']);
    $profileData['experience'] = trim($profileData['experience']);
    $profileData['education'] = trim($profileData['education']);
    
   
    // Define the JSON Schema as a PHP array
    $schema = json_decode('{
        "type": "object",
        "properties": {
            "FullName": { "type": "string", "minLength": 1 },
            "Email": { "type": "string", "format": "email" },
            "PhoneNumber": { "type": "string", "minLength": 7 },
            "Qualifications": { "type": "string" },
            "experience": { "type": "string", "pattern": "^[0-9]+$" },
            "education": {
                "type": "string",
                "enum": ["High School", "Bachelor", "Master", "PhD"]
            }
        },
        "required": ["FullName", "Email", "PhoneNumber", "Qualifications", "experience", "education"]
    }');

    $validator = new Validator();

    // Validate the profile data
    $result = $validator->validate((object)$profileData, $schema);

    if ($result->isValid()) {
        return true;
    }

    // Collect error messages
    $errors = [];

    $error = $result->error(); // get the root error

    if ($error) {
        foreach ($error->subErrors() as $subError) {
            $instanceLocation = implode('.', $subError->data()->path()); // points to field name
            $keyword = $subError->keyword();

            switch ($keyword) {
                case 'minLength':
                    $errors[] = ucfirst($instanceLocation) . ' must not be empty.';
                    break;
                case 'pattern':
                    $errors[] = ucfirst($instanceLocation) . ' must contain only numbers.';
                    break;
                case 'format':
                    $errors[] = ucfirst($instanceLocation) . ' must be a valid email address.';
                    break;
                case 'enum':
                    $errors[] = ucfirst($instanceLocation) . ' must be one of the allowed options.';
                    break;
                default:
                    $errors[] = "Invalid value for " . ucfirst($instanceLocation);
                    break;
            }
        }
    }

    return $errors;
}
