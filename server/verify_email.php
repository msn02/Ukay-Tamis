<?php
    if(isset($_POST['email'])){ // Check if email is set in the POST data
        $email = $_POST['email'];
        
                // check if email already exists

        $stmt1 = $conn->prepare("SELECT user_id, COUNT(*) as count FROM user WHERE email = ?");
        $stmt1->bind_param("s", $email);
        $stmt1->execute();
        $stmt1->store_result();
        $stmt1->bind_result($user_id, $num_rows);
        $stmt1->fetch();

        if($num_rows > 0){
        $stmt2 = $conn->prepare("SELECT question_id FROM user_security_questions WHERE user_id = ?");
        $stmt2->bind_param("i", $user_id);
        $stmt2->execute();
        $stmt2->store_result();
        if ($stmt2->num_rows > 0) {
            $stmt2->bind_result($questionID);
            $stmt2->fetch();
            echo $questionID;
        } else {
            echo "No security question found for this email.";
        }
        }else{
            echo "Email does not exist";
        }
        die();
    }

    if(isset($_POST['question_id'])){
        $question_id = $_POST['question_id'];
        $stmt = $conn->prepare("SELECT question FROM security_questions WHERE question_id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($question);
        $stmt->fetch();
        echo $question;
        die();
    }
    //get answer and compare
    if(isset($_POST['answer'])){
        //get userID
        $answer_input = $_POST['answer'];
        $email = $_POST['email_1'];
        $stmt = $conn->prepare("SELECT user_id FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        //get answer
        $stmt = $conn->prepare("SELECT answer FROM user_security_questions WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($answer);
        $stmt->fetch();

        if($answer == $answer_input){
            echo $user_id;
        }else{
            echo false;
        }
        die();
    }

?>

<script>
    //email verification
    function verify_email(){
        event.preventDefault()
        // AJAX request to verify email
            var email = document.getElementById('input_email').value; // Assuming input field has id 'input_email'
            $.ajax({
                type: 'POST',
                
                data: {
                    email: email
                },
                success: function(data) {
                    // Handle success (response from server)
                    if(data > 0 || data < 11){
                        $('#verify_success_modal').removeClass('d-none');
                        $('#sec_question').prop('disabled', false);
                        $('#verify_email_btn').prop('disabled', true);
                        get_question(data);

                    }else{
                        $('#failed_modal').removeClass('d-none');
                    }

                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.log('Error verifying email:', error);
                }
            });
        };
    function get_question(data){
        $.ajax({
            type: 'POST',
            data: {
                question_id: data
            },
            success: function(data) {
                document.getElementById('sec_question_text').innerHTML = data;
            }
        });
    }
    function answer_check(){
        var answer = document.getElementById('input_ans').value;
        var email = document.getElementById('input_email').value; 
        console.log(answer);
        $.ajax({
            type: 'POST',
            data: {
                answer: answer,
                email_1: email
            },
            success: function(response) {
                if (response != 0){
                    window.location.href = 'change_pass.php';
                     sessionStorage.setItem('user_id', response);
                    }else{
                    $('#failed_modal').removeClass('d-none');
                    $('#verify_success_modal').addClass('d-none');
                    console.log("not confirmed");
                }
            }
        });
    }
</script>

