<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("adminProfileAndSettings");
// print_r($data);
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="my-2 mx-2 adminSettingsDiv">
        <h3 class="text-muted">Edit Admin Settings</h3>
        <?php
        if ($data["system_details"]) {
            $systemDetails = $data["system_details"];
        } else {
            $systemDetails = [];
        }
        ?>

        <h4 class="text-muted font-medium">Please set Academic Start And End Date.</h4>

        <form class="form form-group my-2" id="adminSettingsForm">
            <div class="mb-1 form-group">
                <label for="type" class="form-label">
                    Select Academic Start Date
                </label>
                <input type="date" id="academic_start_date" name="academic_start_date" placeholder="Enter academic start date" value="<?= date('Y-m-d', strtotime($systemDetails[1]["value"])) ?>" />
            </div>
            <div class="mb-1 form-group">
                <label for="type" class="form-label">
                    Select Academic End Date
                </label>
                <input type="date" id="academic_end_date" name="academic_end_date" placeholder="Enter academic end date" value="<?= date('Y-m-d', strtotime($systemDetails[0]["value"])) ?>" />
            </div>

            <div class="mt-1-5 form-group">
                <a href="<?= BASE_URL ?>/adminProfileAndSettings" class="btn btn-info">Back</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>

        </form>
    </div>
</div>

<style>
    .adminSettingsDiv {
        height: 75vh;
    }

    .checkboxLabel {
        display: inline !important;
        font-weight: 400 !important;
    }

    .optionLabel {
        display: block;
        font-size: var(--rv-1-new);
        color: #6c757d;
        font-weight: 600;
        margin-bottom: 0.5rem;
        padding-left: 0.2rem;
        padding-right: 1rem;
    }

    .checkboxInput input[type="checkbox"] {
        margin: 1rem 0.5rem 1rem 0.5rem;
        width: 1rem;
        height: 1rem;

    }
</style>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    $(document).ready(function() {
        $('#adminSettingsForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: BASE_URL + "/adminProfileAndSettings/edit_system_settings",
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 200) {
                        alertUser("success", response.desc);
                        setTimeout(function() {
                            history.go(-1);
                            window.close();
                        }, 2000);
                    } else if (response.status === 400) {
                        alertUser("danger", response.desc);
                    } else {
                        alertUser("warning", response.desc);
                    }
                },
                error: function(xhr, status, error) {
                    alertUser("danger", "Something went wrong. Please try again later.");
                }
            });
        });
    });
</script>