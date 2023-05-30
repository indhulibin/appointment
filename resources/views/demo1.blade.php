<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form>
    <div class="row form-group">
        <label for="date" class="col-sm-1 col-form-label">Date</label>
        <div class="col-sm-4">
            <div class="input-group date" id="datepicker">
                <input type="text" class="form-control" name="appointment_date" id="dateSelect">
                <span class="input-group-append">
                    <span class="input-group-text bg-white d-block">
                        <i class="fa fa-calendar"></i>
                    </span>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group mb-3">
        <select id="state-dd" class="form-control"></select>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(function() {
        $('#datepicker').datepicker({
            startDate: new Date(),
            minDate: 0,
            dateFormat: "dd/mm/yy",
            daysOfWeekHighlighted: "0,6",
            language: 'en',
            daysOfWeekDisabled: [0, 6]
        });
    });

    $(document).ready(function() {
        $('#dateSelect').change(function(event) {
            var appointmentDate = $(this).val();
            $('#state-dd').html('');

            $.ajax({
                url: "/api/fetch-state",
                type: 'POST',
                dataType: 'json',
                data: {
                    appointment_date: appointmentDate,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#state-dd').html('<option value="">Select Slot</option>');
                    $.each(response, function(key, value) {
                        $('#state-dd').append('<option value="' + value.id + '">' + value.slot + '</option>');
                    });
                }
            });
        });
    });
</script>

</body>
</html>