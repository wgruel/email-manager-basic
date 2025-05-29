<?php 

/**
 * Class EmailController
 * 
 * This controller handles the interaction between the user inputs (HTTP requests)
 * and the EmailStorage class. It provides methods for listing, inserting,
 * editing, and deleting email addresses.
 */
class EmailController {

    // Variable to hold the email storage object
    private EmailStorage $ems;

    /**
     * Constructor
     * Initializes the EmailStorage instance using a constant STORAGE_FILE.
     */
    public function __construct() {
        $this->ems = new EmailStorage(STORAGE_FILE);
    }

    /**
     * index()
     * 
     * This method retrieves all email addresses and passes them
     * to the view template that lists them.
     */    
    public function index() {
        $emails = $this->ems->getAll();
        require __DIR__ . '/../Views/emails/list.php';
    }

    /**
     * insert()
     * 
     * Handles inserting a new email address via a POST form.
     * If the email is valid, it is added to storage and the user is redirected.
     * If not, an error message is shown.
     */
    public function insert() {

        // Check if the form was submitted
        if (isset($_POST['btn-save'])) {
            if ($_POST['email']) {
                $this->ems->add($_POST['email']);
                // Redirect to list
                header('Location: index.php?action=index');
                exit;
            }
        }
        // include insert view
        require __DIR__ . '/../Views/emails/insert.php';
    }

    /**
     * edit()
     * 
     * Handles both displaying the edit form (GET request)
     * and processing updates (POST request).
     */    
    public function edit() {

        // if form was submitted via POST 
        // --> store updated email-address 
        // and return to index
        if (isset($_POST['btn-save'])) {
            // if old and new email are provided
            if ($_POST['oldEmail'] && $_POST['newEmail']) {
                // update emailadddress
                $this->ems->update($_POST['oldEmail'], $_POST['newEmail'])
                // redirect to index
                header('Location: index.php?action=index');
                exit;
            }
            $error = 'Ungültige E-Mail oder Aktualisierung fehlgeschlagen.';
        }

        // if edit was called via GET
        // check if email address was provided
        if (!isset($_GET['email'])) {
            header('HTTP/1.0 404 Not Found');
            echo 'Email nicht gefunden.'; exit;
        }
        // if so: provide it to form and display form
        $email = $_GET['email'];
        require __DIR__ . '/../Views/emails/edit.php';
    }

    /**
     * delete()
     * 
     * Deletes an email address specified via GET request and redirects to index
     */    
    public function delete() {
        $email = $_GET['email'];
        $this->ems->delete($email);
        header('Location: index.php?action=index');
        exit;
    }
}
?>