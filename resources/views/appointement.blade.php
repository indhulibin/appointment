<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <title>Document</title>
</head>
<body>
  
<form>
        <div class="row form-group">
            <label for="date" class="col-sm-1 col-form-label">Date</label>
            <div class="col-sm-4">
                <div class="input-group date" id="datepicker">
                    <input type="text" class="form-control" name="appointment_date" id="dateSelect" >
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

    
</body>

<script type="text/javascript">
    $(function() {
        $('#datepicker').datepicker(
            {
                startDate: new Date(),
                minDate: 0,
                format: "yyyy/mm/dd",
                daysOfWeekHighlighted: "0,6",
                language: 'en',
                daysOfWeekDisabled: [0, 6]
            }
        );
    });

    $(document).ready(function() {
        $('#dateSelect').change(function(event) {
            var idCountry = this.value;
            $('#state-dd').html('');
            if (idCountry) {
  // The variable idCountry has a value
  console.log("idCountry has a value: " + idCountry);
} else {
  // The variable idCountry does not have a value
  console.log("idCountry is null, undefined, or empty.");
}
            $.ajax({
            url: "/api/fetch-state",
            type: 'POST',
            dataType: 'json',
            data: {appointment_date: idCountry,_token:"{{ csrf_token() }}"},
            success: function (response) {
                $('#state-dd').html('<option value="">Select City</option>');
                    $.each(response, function (key, value) {
                         $('#state-dd').append('<option value="' + value
                                .id + '">' + value.slot + '</option>');
                    });
            
            }

    
            })
        });
    });
</script>

</html>