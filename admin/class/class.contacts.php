<?php

class contacts {

    public static function contactText() {
        echo "  <p>To view a contact request please click on the envelope, envelopes with a tick have been marked as processed.</p>
                <p>To delete a contact, please click the red X in the top left corner.</p>";
    }

    public static function getContacts() {
         $list = DB::dbQuery("SELECT * FROM contacts ORDER BY contactID ASC;","0");
         return $list;
    }

    public static function getContact($id) {
        $list = DB::dbQuery("SELECT * FROM contacts WHERE contactID='".$id."';","0");
        return $list;
    }

    public static function listContacts() {
       contacts::contactText();
       $contacts = contacts::getContacts();
       while ($results = DB::dbFetch($contacts, 'assoc')) {
           echo "   <div class='contactHolder'>
                        <div class='deleteContact'>
                            <a href='?do=contact&amp;action=remove&amp;id=".$results['contactID']."' title='Delete'></a>
                        </div>
                        <a href='?do=contact&amp;action=edit&amp;id=".$results['contactID']."' title='Contact Form for ".$results['contactName']."'>";
           if ($results['contactCompleted'] == "1") {
               echo "<img src='icons/contactcomplete.png' alt='Contact Form for ".$results['contactName']."' />";
           } else {
               echo "<img src='icons/mail_receive.png' alt='Contact Form for ".$results['contactName']."' />";
           }
           echo "       <br />".$results['contactName']."
                        </a>
                    </div>";
       }

    }

    public static function viewContact($id) {
        $getContact = contacts::getContact($id);
        $contact = DB::dbFetch($getContact,'assoc');
        forms::openForm('editContact', '?do=contact&amp;action=save', 'post');
        forms::fieldsetOpen('Editing '.$contact['contactName'].' Contact');
        forms::input('contactID', '', $contact['contactID'], '', '', 'hidden');
        echo "<ol>";
        echo "<li>";
        forms::input('contactName', '', $contact['contactName'], 'stdText', 'Contact Name:', 'text', true);
        echo "</li>";
        echo "<li>";
        forms::input('contactName', '', $contact['contactEmail'], 'stdText', 'Contact Email:', 'text', true);
        echo " | <a href='mailto:".$contact['contactEmail']."'>Email this Customer</a>";
        echo "</li>";
        echo "<li>";
        forms::input('contactName', '', $contact['contactNumber'], 'stdText', 'Contact Number:', 'text', true);
        echo "</li>";
        echo "<li>";
        forms::input('contactCompleted', '', $contact['contactCompleted'], 'stdChkBox', 'Completed:', 'checkbox');
        echo " | Check if completed";
        echo "</li>";
        echo "<li>";
        forms::input('saveContact', '', 'Save', 'stdButton', '&nbsp;', 'submit');
        echo "</li>";
        echo "</ol>";
        forms::fieldsetClose();
        forms::closeForm();
    }

    public static function completeContact() {
        if (isset($_REQUEST['contactCompleted']) && $_REQUEST['contactCompleted'] != "") {
            $complete = "1";
        } else {
            $complete = "0";
        }
        if (DB::dbQuery("UPDATE contacts SET contactCompleted='".$complete."' WHERE contactID='".$_REQUEST['contactID']."';","0")) {
            echo "<p>Contact Information has been updated.</p>
                <p><a href='?do=contact' title='Back to Contacts'>Back to Contacts</a></p>";
        }
    }

    public static function deleteContact($id) {
        if (isset($_REQUEST['go'])) {
            if (DB::dbQuery("DELETE FROM contacts WHERE contactID='".$_REQUEST['id']."';","0")) {
                echo "  <p>Contact Information has been deleted.</p>
                        <p><a href='?do=contact' title='Back to Contacts'>Back to Contacts</a></p>";
            }

        } else {
            $cont = contacts::getContact($id);
            $data = DB::dbFetch($cont, 'assoc');
            echo "<p>You have chosen to delete the contact request from <strong><em>".$data['contactName'].":</em></strong><br /><br />
                        ".$data['contactEmail']."<br />
                        ".$data['contactNumber']."<br />
                    </p>
                </div>
                    <p>Please confirm you wish to delete this contact request. This will remove it from the database.</p>
                    <p><blink><em class='warning'>This cannot be undone</em></blink></p>
                    <p>I wish to delete this contact request? <span><a href='?do=contact' alt='CANCEL'>No</a></span>|<span><a href='?do=contact&amp;action=remove&amp;id=".$id."&amp;go' alt='DELETE'>Yes</span></p>";
        }
    }

}

?>
