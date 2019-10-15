<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Facilities</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
</head>
<body>

<div class="container">
  <h2>Add Facilities</h2>
  <form id="facility_form" method="POST">
    {{ csrf_field() }}
    <div class="form-group ">
        <label class="control-label" for="facility">Facility</label>
        <select class="form-control" name="facility" id="facility">
            @if ($facilty)
            @foreach($facilty as $key => $facilties)
              <option value="{{$key}}">{{$facilties}}</option>
            @endforeach
            @endif
        </select>
    </div>
      <div class="form-group"> <!-- Date input -->
        <label class="control-label" for="date">Date</label>
        <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text" required="" />
      </div>
    <div class="form-group">
        <label class="control-label" for="time">Time</label>
        <select class="form-control" name="time" id="time">
            @if($time)
            <option>Select Time</option>
            @foreach($time as $key => $times)
              <option value="{{$key}}">{{$times}}</option>
            @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="time">Amount</label>
        <h5 id="amount"></h5>
    </div>

    <button type="button" id="submit_fac" class="btn btn-primary">Submit</button>
  </form>
</div>

<script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]');
      var options={
        format: 'mm/dd/yyyy',
        todayHighlight: true,
        autoclose: true,
        orientation: "top",
      };
      date_input.datepicker(options);
    })

    $("#time").change(function(){
        var time = $(this).val();
        if (time == 1){
            $("#amount").text("Rs 100");
        }else{
            $("#amount").text("Rs 500");
        }

    });

    $("#submit_fac").click(function(e){
        var facility_name = $("#facility").val();
        var date = $("#date").val();
        var time = $("#time").val();

        var data = {
            "_token": "{{ csrf_token() }}",
            'name' : facility_name,
            'date' : date,
            'time' : time,
            };
        $.ajax({
            type: "POST",
            url : "/sub",
            data: data,
            success: function(data)
           {
               console.log(data['failed']);
               if (data.failed){
                alert("Already Booked");
               }
               else{
                alert("Booking Successful");
               }
           }
        });
    });
</script>

</body>
</html>
