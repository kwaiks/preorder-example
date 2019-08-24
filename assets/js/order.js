var ukuran = document.getElementById("ukuran-list");
var alert1 = document.getElementById("check-alert");
var alert2 = document.getElementById("nama-alert");
var alert3 = document.getElementById("nim-alert");
var alert4 = document.getElementById("tak-alert");
var cekbox = document.getElementsByClassName("item").length;
console.log(cekbox);
var proc = false;
var total = 0;
$(document).ready(function () {
    $("#submitBtn").click(function () {
        $("#myform").submit();
    });
    $("#modal-btn-b").click(function () {
        $("#j1").remove();
        $("#mi-modal").modal('hide');
    });
    
    //         $('#myform').validate({ // initialize the plugin
    //     rules: {
    //         nama: {
    //             required: true,
    //             email: true
    //         },
    //         nim: {
    //             required: true,
    //             minlength: 5
    //         }
    //     }
    // });
});
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
  }
$('#mi-modal').on('hidden.bs.modal', function () {
    for(i=0; i<cekbox;i++){
        $("#item-modal"+i).attr( "style", "display: none !important;" );
    };
    total = 0;
})
$("#ukuran").change(function(){
    var status = this.value;
    $("#ui").text(status);
});
$(".sandang").change(function () {
    if (this.checked) {
        $("#ukuran-list").show();
    } else if ($('.sandang:checked').length == 0) {
        $("#ukuran-list").hide();
    }
});
$(".item").change(function () {
    if (this.checked) {
        alert1.style.display = "none";
        proc = true;
    }
});
$('#nama').on('input', function () {
    alert2.style.display = "none";
    proc = true;
});
$('#kontak').on('input', function () {
    alert4.style.display = "none";
    proc = true;
});
$('#nim').on('input', function () {
    alert3.style.display = "none";
    proc = true;
});
$("#mdBtn").click(function () {
    if (($("input:checkbox[name='kode[]']:checked").length) == 0) {
        alert1.style.display = "block";
        proc = false;
    }
    if ($("#nama").val() == '') {
        alert2.style.display = "block";
        proc = false;
    }
    if ($("#nim").val() == '') {
        alert3.style.display = "block";
        proc = false;
    }
    if ($("#kontak").val() == '') {
        alert4.style.display = "block";
        proc = false;
    }
    if (proc == true) {
        $(".item").each(function(i){
            if (this.checked) {
                $("#item-modal"+i).attr( "style", "display: block !important;");
                total = total + parseInt($("#nilai"+i).val());
            };
        });
        // $("input:checkbox[name='kode[]']:checked").each(function () {
        //     switch ($(this).val()) {
        //         case 'h1':
        //             total = total + parseInt($("#nilai1").val());
        //             $("#item-modal1").attr( "style", "display: block !important;");
        //             break;
        //         case 'j1':
        //             $("#item-modal").append('<li class="list-group-item d-flex justify-content-between" id="j1""><div><h6 class="my-0">Jaket Bomber</h6><small class="text-muted">Ukuran ' + $("#ukuran").val() + '</small></div><span class="text-muted">Rp 170000</span></li>');
        //             total = total + 170000;
        //             break;
        //         case 'l1':
        //             $("#item-modal").append('<li class="list-group-item d-flex justify-content-between" id="l1""><div><h6 class="my-0">Lanyard</h6></div><span class="text-muted">Rp 20000</span></li>');
        //             total = total + 20000;
        //             break;
        //         case 'e1':
        //             $("#item-modal").append('<li class="list-group-item d-flex justify-content-between" id="e1""><div><h6 class="my-0">E-Money</h6><small class="text-muted">Kode : E1</small></div><span class="text-muted">Rp 80000</span></li>');
        //             total = total + 80000;
        //             break;
        //         case 'e2':
        //             $("#item-modal").append('<li class="list-group-item d-flex justify-content-between" id="e2""><div><h6 class="my-0">E-Money</h6><small class="text-muted">Kode : E2</small></div><span class="text-muted">Rp 80000</span></li>');
        //             total = total + 80000;
        //             break;
        //         case 'e3':
        //             $("#item-modal").append('<li class="list-group-item d-flex justify-content-between" id="e3""><div><h6 class="my-0">E-Money</h6><small class="text-muted">Kode : E3</small></div><span class="text-muted">Rp 80000</span></li>');
        //             total = total + 80000;
        //             break;
        //         case 'e4':
        //             $("#item-modal").append('<li class="list-group-item d-flex justify-content-between" id="e4""><div><h6 class="my-0">E-Money</h6><small class="text-muted">Kode : E4</small></div><span class="text-muted">Rp 80000</span></li>');
        //             total = total + 80000;
        //             break;
        //         default:
        //             alert("Checkbox is unchecked.");
        //             break;
        //     }
        //     console.log("tertipu ");
        // });
        $("#nama-mdl").text($("#nama").val());
        $("#nim-mdl").text($("#nim").val());
        $("#tak-mdl").text($("#kontak").val());
        $("#total").text(formatNumber(total));
        $("#mi-modal").modal('show');
    }
});