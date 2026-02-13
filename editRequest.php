<?php 
/**
 * Edit Request Form Page
 * 
 * This page displays a form to edit existing OJT requests. It retrieves the request
 * data from the database based on the request_no passed via POST request.
 */

require_once 'dbConfig.php';
require_once 'sessionChecker.php';

// Handle POST request to retrieve request data for editing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestNo = $_POST['request_no'];
    
    // Fetch the request details from the database
    $stmt = $pdo->prepare("SELECT * FROM request_list WHERE request_no = :request_no");
    $stmt->execute(['request_no' => $requestNo]);
    $request = $stmt->fetch(PDO::FETCH_ASSOC);

    // Calculates total attachments
    $existingFiles = array_filter(explode(',', $request['request_attachment'])); 
    $currentCount = count($existingFiles);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/editRequest.css?v=1.2">
    <title>Edit Request Form</title>
</head>
<body>    
    <!-- Request Form Parent Container -->
    <div class="request-form-container">
        <div class="form-title-container">
            <h2 class="form-title">Edit OJT Request Form</h2>
        </div>
        <form action="submitRequestAuth.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="request_no" value="<?php echo $requestNo ?>">
            <input type="hidden" id="existing-file-count" value="<?php echo $currentCount; ?>">
            <div class="row">
                <div class="form-group"> <!-- Subject Input Field -->
                    <label for="request-subject" class="form-label">Subject:</label>
                    <input type="text" id="request-subject" name="request-subject" class="general-input" value="<?php echo $request['request_subject'] ?>">
                </div>
                <div class="form-group"> <!-- Current Date -->
                    <label for="date" class="form-label">Date:</label>
                    <input type="date" id="date" name="date" class="general-input" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>                
                <div class="form-group"> <!-- Additional Attachment Field -->
                    <label for="attachment" class="form-label">Upload Additional Files:</label>
                    <input type="file" id="attachment" name="attachment[]" class="general-input" onchange="validateFileLimit(this)" accept=".pdf, .jpg, .jpeg, .png" multiple>
                </div>
            </div>
            <div class="row main-request-area">
                <div class="form-group main-request"> <!-- Main Request Text Area -->
                    <label for="main-request" class="form-label">Main Request:</label>
                    <textarea id="main-request" name="main-request" class="general-input request-input" rows="1"><?php echo $request['request_main'] ?></textarea>   
                </div>           
                <div class="form-group">  <!-- List of current uploaded attachments -->
                    <label class="form-label">Current Attachments:</label>
                    <div class="scrollable">
                        <?php 
                            $files = explode(',', $request['request_attachment']); 
                            foreach ($files as $file):                             
                        ?>
                        <?php if (!empty($file)): ?>                    
                            <div class="file-item" style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                                <a href="uploads/<?php echo $request['request_no_display']; ?>/<?php echo $file; ?>" target="_blank"><?php echo $file; ?></a>
                                <div class="remove-container">
                                    <input type="checkbox" name="remove_files[]" value="<?php echo $file; ?>">
                                    <label style="color: red; font-size: 0.8rem;">Remove</label>
                                </div>
                            </div>
                        <?php else: ?>   
                            <p class="no-requests" style='padding: 20px; text-align: center; color: #666;'>No requests submitted yet.</p> 
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>            
            <div class="btn-submit-container">
                <input type="submit" value="Submit Edited Request" class="btn-submit">
            </div>
        </form>
        </div>
    </div>  
    
    <!-- Scripts -->
    <script src="js/sendHeartbeat.js"></script>
    <script src="js/fileLimit.js"></script>
    <script src="js/fileRemoval.js"></script>
</body>
</html>