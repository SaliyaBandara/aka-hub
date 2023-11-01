<?php
class UploadFiles extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/courses");
        die();
    }

    public function index()
    {
        $data = [
            'title' => 'Courses',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('student/courses/index', $data);
    }


    public function img($file_prefix = "")
    {
        $this->requireLogin();

        $file_prefix = filter_var($file_prefix, FILTER_SANITIZE_STRING);
        if (isset($_FILES["file"]["name"])) {
            $now = new DateTime();
            $digits = 4;

            $uploadPath = $newFilename = NULL;

            $newFilename = $file_prefix . "_";
            $uploadPath = "./assets/user_uploads/img/";

            $allowed_prefixes = ["course_cover"];
            if (!in_array($file_prefix, $allowed_prefixes))
                $this->errorImg401("Invalid Request");

            $newFilename .= $now->format('YmdHis') . uniqid() . preg_replace('/[\s.,-]+/', '', trim(strtolower(microtime()))) . (rand(pow(10, $digits - 1), pow(10, $digits) - 1));

            $fileSize = $_FILES["file"]["size"]; // File size in bytes
            $fileName = $_FILES["file"]["name"]; // The file name
            $fileTmpLoc = $_FILES["file"]["tmp_name"]; // File in the PHP tmp folder
            $fileType = $_FILES["file"]["type"]; // The type of file it is
            $fileErrorMsg = $_FILES["file"]["error"]; // 0 for false... and 1 for true

            // Verify if valid image file
            $valid_image = false;
            $isImage = $this->checkImage($fileSize, $fileName, $fileTmpLoc, $fileType, $fileErrorMsg);

            if ($isImage != 0) {
                if ($isImage == 1)
                    $this->errorImg401("Not a valid image");
                else if ($isImage == 2)
                    $this->errorImg401("Please make sure that your image is in the format JPEG or PNG");
                else if ($isImage == 3)
                    $this->errorImg401("Please make sure that your image is in the format JPEG or PNG");
                else if ($isImage == 4)
                    $this->errorImg401("Please select a file before clicking upload");
                else
                    $this->errorImg401("Not a valid image");
                die;
            }

            $valid_image = true;

            $extension = "";
            if ($this->fileExtension($fileName) == "svg" && $this->isSVG($fileTmpLoc)) {
                $extension = ".svg";
            } else {
                $extension = ".jpg";
                list($width, $height, $type, $attr) = getimagesize($_FILES["file"]["tmp_name"]);

                if ($type != 2 && $type != 3)
                    $this->errorImg401("Please make sure that your image is in the format JPEG or PNG");

                if ($type == 3)
                    $extension = ".png";
            }

            $sizeLimit = 3 * 1024 * 1024;

            if ($fileSize >= $sizeLimit)
                $this->errorImg401("File size is larger than $sizeLimit MB");

            if ($fileType != "image/jpeg" && $fileType != "image/png" && $fileType != "image/svg+xml")
                $this->errorImg401("Please make sure that your image is in the format JPEG, PNG or SVG");

            if (!$fileTmpLoc) {
                http_response_code(401);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode("Please select a file before clicking upload");
                die;
            }

            // $fileNameFinal = $newFilename . "@3x" .  $extension;
            $fileNameFinal = $newFilename .  $extension;

            if (move_uploaded_file($fileTmpLoc, $uploadPath . $fileNameFinal)) {
                http_response_code(200);
                header('Content-Type: application/json; charset=utf-8');
                echo (json_encode(array("status" => "200", "desc" => "File upload successful", "filename" => $fileNameFinal)));
            }

            // resize_image($uploadPath, $fileNameFinal, $newFilename, $extension, $type, 1, (1 / 3));
            // resize_image($uploadPath, $fileNameFinal, $newFilename, $extension, $type, 2, (2 / 3));

            die;
        }
    }
    public function pdf($file_prefix = "")
    {
        $this->requireLogin();

        $file_prefix = filter_var($file_prefix, FILTER_SANITIZE_STRING);
        if (isset($_FILES["file"]["name"])) {
            $now = new DateTime();
            $digits = 4;

            $uploadPath = $newFilename = NULL;

            $newFilename = $file_prefix . "_";
            $uploadPath = "./assets/user_uploads/pdf/";

            $allowed_prefixes = ["course_materials"];
            if (!in_array($file_prefix, $allowed_prefixes))
                $this->errorImg401("Invalid Request");

            $newFilename .= $now->format('YmdHis') . uniqid() . preg_replace('/[\s.,-]+/', '', trim(strtolower(microtime()))) . (rand(pow(10, $digits - 1), pow(10, $digits) - 1));

            $fileSize = $_FILES["file"]["size"]; // File size in bytes
            $fileName = $_FILES["file"]["name"]; // The file name
            $fileTmpLoc = $_FILES["file"]["tmp_name"]; // File in the PHP tmp folder
            $fileType = $_FILES["file"]["type"]; // The type of file it is
            $fileErrorMsg = $_FILES["file"]["error"]; // 0 for false... and 1 for true

            // Verify if valid file
            if ($fileType != "application/pdf")
                $this->errorImg401("Not a valid pdf file");

            $extension = ".pdf";
            $sizeLimit = 10 * 1024 * 1024;

            if ($fileSize >= $sizeLimit)
                $this->errorImg401("File size is larger than $sizeLimit MB");

            if ($fileType != "application/pdf")
                $this->errorImg401("Please make sure that your file is in the format: PDF");

            if (!$fileTmpLoc)
                $this->errorImg401("Please select a file before clicking upload");

            // $fileNameFinal = $newFilename . "@3x" .  $extension;
            $fileNameFinal = $newFilename .  $extension;

            if (move_uploaded_file($fileTmpLoc, $uploadPath . $fileNameFinal)) {
                http_response_code(200);
                header('Content-Type: application/json; charset=utf-8');
                echo (json_encode(array("status" => "200", "desc" => "File upload successful", "filename" => $fileNameFinal)));
            }

            die;
        }
    }

    public function create_error($message)
    {
        $error = array(
            "error" => array(
                "message" => $message
            )
        );
        echo json_encode($error);
        die;
    }

    function errorImg401($message)
    {
        http_response_code(401);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode("$message");
        die;
    }

    function fileExtension($s)
    {
        $n = strrpos($s, ".");
        return ($n === false) ? "" : substr($s, $n + 1);
    }

    function isSVG($fileTmpLoc)
    {
        $xml = simplexml_load_file($fileTmpLoc);
        if (!$xml)
            return (false);

        $rootName = $xml->getName();
        if ($rootName !== 'svg')
            return (false);

        return (true);
    }


    function checkImage($fileSize, $fileName, $fileTmpLoc, $fileType, $fileErrorMsg)
    {
        $valid_image = false;

        // check if extension is svg
        $extension = $this->fileExtension($fileName);
        if ($extension == "svg") {
            $xml = simplexml_load_file($fileTmpLoc);
            if (!$xml)
                return (1);

            $rootName = $xml->getName();
            if ($rootName !== 'svg')
                return (1);

            return (0);
        }

        if (@is_array(getimagesize($fileTmpLoc)))
            $valid_image = true;
        else
            return (1);

        list($width, $height, $type, $attr) = getimagesize($fileTmpLoc);

        if ($type != 2 && $type != 3)
            return (2);

        if ($fileType != "image/jpeg" && $fileType != "image/png")
            return (3);

        if (!$fileTmpLoc)
            return (4);

        return (0);
    }
}
