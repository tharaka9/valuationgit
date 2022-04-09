
 <style>
#mytable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#mytable td, #mytable th {
  border: 1px solid #ddd;
  padding: 8px;
}

#mytable tr:nth-child(even){background-color: #f2f2f2;}

#mytable tr:hover {background-color: #ddd;}

#mytable th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #506F8A;
  color: white;
}

 </style>
 
<div class="container-fluid">

<div class="row">
    <div class="col-md-12 school-options-dropdown text-center">
    <div class="dropdown btn-group">

        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Choose a Report

        </button>

        <div class="dropdown-menu">
            <a class="dropdown-item" id="customer" href="#">Customers</a>
            <a class="dropdown-item" id="finance" href="#">Finance Company</a>
            <a class="dropdown-item" id="employee" href="#">Employee</a>
            <!-- <a class="dropdown-item" id="test3" href="#">Test3</a> -->
        </div>

    </div>
    </div>
</div>
<div class="dropdown-divider" style="border-top: 1px solid #000;"></div>

<div id="table-container">
<h4 class="text-center" style="margin-top: 15%;">Report Will Show Here</h4>

</div>

</div>


<script>

$(document).on('click','.dropdown-item',function(e){
    var name = $(this).attr("id");

    $.ajax({
      url: _base_url_+'admin/reports/manage_category.php',
      type: 'POST',
      data: {
        'name': name,
      },
      success: function(data){
        $("#table-container").html(data);
                    $('#mytable').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
        
      }

    });
});

</script>
