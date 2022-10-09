

let check = document.querySelectorAll("#active");
check.forEach((element) => {
    element.addEventListener("change", function (e) {
        e.target.checked == true
            ? (this.value = "true")
            : (this.value = "false");
    });
});
/*
function getPosition(ele){
    const options = {
        enableHighAccuracy: true,
        timeout: 2000,
        maximumAge: 0,
    };

    function success(pos) {
        const crd = pos.coords;
        ele.val(crd.latitude + " , " + crd.longitude);

        let url="src=https://maps.googleapis.com/maps/api/geocode/json?lating="+crd.latitude+"  , "+crd.longitude+"&sensor=false";
        $.get(url,function(data){
            console.log(data);
        });
    }
    function error(){
        console.warn('error');
    }
        navigator.geolocation.getCurrentPosition(success, error, options);
}
*/
//get position of city
$('#add_city #name').on('focus',function(){
    $('#add_city #position').val('');
});
$('#add_city #name').on('blur',function(){
    getCoord($(this).val().trim(),$('#add_city #position'));
})
/*
$('#edit_city #name').on('blur',function(){
    getCoord($(this).val().trim(),$('#edit_city #position'));
})*/
function getCoord(value,ele){
    $.get('https://api.openweathermap.org/data/2.5/weather?q='+value+'&appid=1600477190cb6960ea586b51abe8b4ba',function(data){
        ele.val(data.coord.lat+' , '+data.coord.lon);
    });
   /* setTimeout(() => {
        if(ele.val()=='')
            $('.modal.show #name').addClass('border-danger');
        else
            $('.modal.show #name').removeClass('border-danger');
    }, 1000);*/
}


//links table prevent default
let links = document.querySelectorAll("table a");
links.forEach((ele) => {
    ele.addEventListener("click", function (e) {
        e.preventDefault();
    });
});
function Access_ajax(form, modal, url, data, action) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url,
        data: data,
        type: "POST",
        dataType: "json",
        success: function (data) {
            let msg = "";
            if (action == "add_country") {
                let active = data.active == 1 ? "Yes" : "No";
                $("#tb_country").append(
                    '<tr id="country_' +
                        data.id +
                        '"><td>' +
                        data.id +
                        "</td><td>" +
                        data.name +
                        "</td><td>" +
                        data.code +
                        "</td><td>" +
                        active +
                        ' </td><td><a class="btn btn-warning" onclick="EditCountry(' +
                        data.id +
                        ')"><i class="fa-solid fa-pen-to-square"></i></a></td><td><a class="btn btn-danger" onclick="DeleteCountry(' +
                        data.id +
                        ')"><i class="fa-solid fa-trash-can"></i></a></td></tr>'
                );
                msg = "successfully added";
            }else if(action=='add_trailer'){
                data=data[0];
                $("#tb_Trailer").append(
                    '<tr id="Trailer_' +
                        data.id +
                        '"><td>' +
                        data.id +
                        "</td><td>" +
                        data.numero +
                        "</td><td>" +
                        data.volum +
                        "</td><td>" +
                        data.trailer +
                        ' </td><td><a class="btn btn-warning" onclick="EditTrailer(' +
                        data.id +
                        ')"><i class="fa-solid fa-pen-to-square"></i></a></td><td><a class="btn btn-danger" onclick="DeleteTrailer(' +
                        data.id +
                        ')"><i class="fa-solid fa-trash-can"></i></a></td></tr>'
                );
                msg = "successfully added";
            }else if(action=='edit_trailer'){
                    data=data[0];
                    $('#Trailer_'+data.id+' td:nth-child(2)').text(data.numero);
                    $('#Trailer_'+data.id+' td:nth-child(3)').text(data.volum);
                    $('#Trailer_'+data.id+' td:nth-child(4)').text(data.trailer);
                    msg = "successfully updated";
            }
            else if(action=='add_city'){
                let active=data.active==1?'checked':'';
                $('#tb_city').append(
                    '<tr id="city_'+data.id+'"><td>'+data.id+
                    '</td><td>'+data.name+
                    '</td><td>'+data.position+
                    '</td><td><input type="checkbox" id="toggle-two" '+active+' onchange="changeToggle('+data.id+')"  data-toggle="toggle" data-size="sm" data-onstyle="outline-success" data-offstyle="outline-danger" data-on="Yes" data-off="No"></td><td><a class="btn btn-danger" onclick="DeleteCity('+data.id+
                    ')"><i class="fa-solid fa-trash-can"></i></a></td></tr>');
                    toggleCheck();
                msg = "successfully added";
            }else if(action=='edit_city'){
                let active=data.active == 1 ? "Yes" : "No";
                $('#city_'+data.id+' td:nth-child(2)').text(data.name);
                $('#city_'+data.id+' td:nth-child(3)').text(data.position);
                $('#city_'+data.id+' td:nth-child(4)').html('<input type="checkbox" id="toggle-two" '+active+' onchange="changeToggle('+data.id+')" data-toggle="toggle" data-size="sm" data-onstyle="outline-success" data-offstyle="outline-danger" data-on="Yes" data-off="No">');
                msg = "successfully updated city";
            }else if(action=='add_devise'){
                editBodyDevise(data);
                msg = "successfully added";
            }else if(action =='edit_devise'){
                editBodyDevise(data);
                msg = "successfully updated devise";
            }else if(action=='edit_trailertype'){
                $('#TT_'+data.id+' td:nth-child(2)').text(data.name);
                $('#TT_'+data.id+' td:nth-child(3)').text(data.active == 1 ? "Yes" : "No");
                msg = "successfully updated";
            }else if(action=='add_trailertype'){
                let active=data.active == true ? 'Yes' : 'No' ;
                $('#tb_TT').append('<tr id="TT_'+data.id+'"><td>'+data.id+'</td><td>'+data.name+'</td><td>'+active+'</td><td><a class="btn btn-warning" onclick="EditTrailerType('+ data.id +')"><i class="fa-solid fa-pen-to-square"></i></a></td><td><a class="btn btn-danger" onclick="DeleteTrailerType('+ data.id +')"><i class="fa-solid fa-trash-can"></i></a></td></tr>');
                msg = "successfully added";
            }
            else if (action == "edit_country") {
                $("#country_" + data.id + " td:nth-child(2)").text(data.name);
                $("#country_" + data.id + " td:nth-child(3)").text(data.code);
                $("#country_" + data.id + " td:nth-child(4)").text(
                    data.active == 1 ? "Yes" : "No"
                );
                msg = "successfully updated country";
            } else reset_form(form, modal);
            if (msg != "") affiche_status(msg);
            reset_form(form, modal);
        },
        error: function (data) {
            warning_action(form, modal, data);
        },
    });
}
// edit body table devise
function editBodyDevise(data){
    $.each($('#tb_devise tr'),function(key,value){
        value.remove();
    })
    $.each(data,function(key,data)
    {
        let active=data.active == true ? 'Yes' : 'No';
        let local=data.local == true ? 'active' : 'not active'
        $('#tb_devise').append('<tr id="device_'+data.id+'"><td>'+data.id+'</td><td>'+data.name+'</td><td>'+data.divis+'</td><td>'+active+'</td><td>'+local+'</td><td><a class="btn btn-warning" onclick="EditDevice('+data.id+')"><i class="fa-solid fa-pen-to-square"></i></a></td><td><a class="btn btn-danger" onclick="DeleteDevice('+data.id+')"><i class="fa-solid fa-trash-can"></i></a></td></tr>');
    });
}
function warning_action(form, modal, data) {

    $("form .validation").append('<div class="alert alert-danger alert-dismissible fade show"><ul></ul></div>');
    $.each(data.responseJSON.errors, function (key, v) {
        $("form .validation .alert").append("<li>" + v + "</li>");
    });
    $('form .validation .alert').append('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
}
function reset_form(form, modal) {
    form.reset();
    modal.modal("hide");
}

//add country
$("#add_country form").on("submit", function (e) {
    e.preventDefault();
    Access_ajax(
        $("#add_country form")[0],
        $("#add_country"),
        "/country",
        {
            name: $("#add_country #name").val(),
            code: $("#add_country #code").val(),
            active: $("#add_country #active").val() == "true" ? 1 : 0,
        },
        "add_country"
    );
});
//edit country
$("#edit_country form").on("submit", function (e) {
    e.preventDefault();
    Access_ajax(
        $("#edit_country form")[0],
        $("#edit_country"),
        "/country/update",
        {
            id: $("#edit_country #id_country").val(),
            name: $("#edit_country #name").val(),
            code: $("#edit_country #code").val(),
            active: $("#edit_country #active").val() == "true" ? 1 : 0,
        },
        "edit_country"
    );
});
//delete country
function DeleteCountry(id) {
    $.get("/country/delete/" + id, function (data) {
        if (data == 1) {
            $("#country_" + id + "").remove();
            affiche_status("successfully deleted");
        }
    });
}
//show function
function EditCountry(id) {
    $.get("/country/" + id + "/show", function (data) {
        if (data != null) {
            let active = data.active == 1 ? "true" : "false";
            if (active == "true")
                $("#edit_country #active").attr("checked", "checked");
            else $("#edit_country #active").removeAttr("checked");
            $("#edit_country #name").val(data.name);
            $("#edit_country #id_country").val(data.id);
            $("#edit_country #code").val(data.code);
            $("#edit_country #active").val(active);
            $("#edit_country").modal("show");
        }
    });
}
//affiche status
function affiche_status(msg) {
    $(".validation").append(
        '<div class="alert alert-success" role="alert">' + msg + "</div>"
    );
    setTimeout(() => {
        $(".validation .alert").remove();
    }, 3000);
}


//add city
$("#add_city form").on("submit", function (e) {
    e.preventDefault();
    Access_ajax(
        $("#add_city form")[0],
        $("#add_city"),
        "/city",
        {
            name: $("#add_city #name").val(),
            country_id: parseInt($('#add_city option:selected').val()),
            position: $("#add_city #position").val(),
            active:$("#add_city #active").val() == "true" ? 1 : 0,
        },
        "add_city"
    );
});
//edit city

$("#edit_city form").on("submit", function (e) {
    e.preventDefault();
    Access_ajax(
        $("#edit_city form")[0],
        $("#edit_city"),
        "/city/update",
        {
            id: $("#edit_city #id").val(),
            name: $("#edit_city #name").val(),
            country_id: parseInt($('#edit_city option:selected').val()),
            position: $("#edit_city #position").val(),
            active: $("#edit_city #active").val() == "true" ? 1 : 0,
        },
        "edit_city"
    );
});
//delete city
function DeleteCity(id) {
    $.get("/city/delete/" + id, function (data) {
        if (data == 1) {
            $("#city_" + id + "").remove();
            affiche_status("successfully deleted");
        }
    });
}
//show function city
function EditCity(id) {
    $.get("/city/" + id + "/show", function (data) {
        if (data != null) {
            let active = data.active == 1 ? "true" : "false";
            if (active == "true")
                $("#edit_city #active").attr("checked", "checked");
            else $("#edit_city #active").removeAttr("checked");
            $("#edit_city #id").val(data.id);
            $("#edit_city #name").val(data.name);
            $("#edit_city #active").val(active);
            $("#edit_city #position").val(data.position);
            //getPosition($("#edit_city #position"))
            let Opts=$('#edit_city option');
            $.each(Opts,function(key,ele){
                $('#edit_city select').selectedIndex=data.country_id
            });
            $("#edit_city").modal("show");
        }
    });
}


//Devise


//local value
let checkLocal = document.querySelectorAll("#local");
checkLocal.forEach((element) => {
    element.addEventListener("change", function (e) {
        e.target.checked == true
            ? (this.value = "true")
            : (this.value = "false");
    });
});
//add Devise
$("#add_devise form").on("submit", function (e) {
    e.preventDefault();
    Access_ajax(
        $("#add_devise form")[0],
        $("#add_devise"),
        "/devise",
        {
            name: $("#add_devise #name").val(),
            divis:$("#add_devise #divis").val(),
            local:$("#add_devise #local").val() == "true" ? 1 : 0,
            active:$("#add_devise #active").val() == "true" ? 1 : 0,
        },
        "add_devise"
    );
});
//edit city
$("#edit_devise form").on("submit", function (e) {
    e.preventDefault();
    Access_ajax(
        $("#edit_devise form")[0],
        $("#edit_devise"),
        "/devise/update",
        {
            id: $("#edit_devise #id").val(),
            name: $("#edit_devise #name").val(),
            divis:$("#edit_devise #divis").val(),
            local:$("#edit_devise #local").val() == "true" ? 1 : 0,
            active:$("#edit_devise #active").val() == "true" ? 1 : 0,
        },
        "edit_devise"
    );
});
//Delete Device
function DeleteDevice(id) {
    $.get("/devise/delete/" + id, function (data) {
        editBodyDevise(data);
    });
}
//show function devise
function EditDevice(id) {
    $.get("/devise/" + id + "/show", function (data) {
        console.log(data);
        if (data!=null) {
            let active = data.active == 1 ? "true" : "false";
            if (active == "true"){
                $("#edit_devise #active").val('true');
                $("#edit_devise #active").attr("checked", "checked");
            }
            else{
                $("#edit_devise #active").val('false');
                $("#edit_devise #active").removeAttr("checked");
            }
            let local = data.local == 1 ? "true" : "false";
            if (local == "true"){
                $("#edit_devise #active").val('true');
                $("#edit_devise #local").attr("disabled", "");
                $("#edit_devise #local").attr("checked", "checked");
            }
            else{
                $("#edit_devise #active").val('false');
                $("#edit_devise #local").removeAttr("checked");
                $("#edit_devise #local").removeAttr("disabled");
            }
            $("#edit_devise #id").val(data.id);
            $("#edit_devise #name").val(data.name);
            $("#edit_devise #active").val(active);
            $("#edit_devise #local").val(local);
            $("#edit_devise #divis").val(data.divis);
            $("#edit_devise").modal("show");
        }
    });
}


//add city bass donne

/*

                $.get('https://api.openweathermap.org/data/2.5/weather?q='+city+'&appid=1600477190cb6960ea586b51abe8b4ba',function(data){
                    position =''+data.coord.lat+' , '+data.coord.lon+'';
                    arr.push({city : city,position:position});
                });

*/
/*
setTimeout(() => {
    insert_data();

}, 5000);
*/
function insert_data(){
    $.getJSON('../ma.json',function(data){
            let vills=data.ville;
            vills.forEach(element => {
                let city=element.city.trim();
                let position=''+element.lat+' , '+element.lng+'';
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        url: '/city',
                        type: "POST",
                        dataType: "json",
                        data:{
                            name: city,
                            position: position,
                            country_id: 1,
                            active: 1
                        },
                        success:function(data){
                            console.log(data)
                        },
                        error:function(data){
                            console.log(data);
                        }
                    });
            });
        }
    );

}


        //trailer
    //add
        $("#add_Trailer form").on("submit", function (e) {
            e.preventDefault();
            Access_ajax(
                $("#add_Trailer form")[0],
                $("#add_Trailer"),
                "/trailer",
                {
                    numero: $("#add_Trailer #numero").val(),
                    trailertype_id: parseInt($("#add_Trailer form select").val()),
                    volum: parseFloat($("#add_Trailer #v").val()),
                },
                "add_trailer"
            );
        });
        //edit
        $("#edit_Trailer form").on("submit", function (e) {
            e.preventDefault();
            Access_ajax(
                $("#edit_Trailer form")[0],
                $("#edit_Trailer"),
                "/trailer/update",
                {
                    id: $("#edit_Trailer #id").val(),
                    numero: $("#edit_Trailer #numero").val(),
                    trailertype_id: parseInt($("#edit_Trailer form select").val()),
                    volum: parseFloat($("#edit_Trailer #v").val()),
                },
                "edit_trailer"
            );
        });
        //Delete
        function DeleteTrailer(id) {
            $.get("/trailer/delete/" + id, function (data) {
                if(data==1)
                $('#Trailer_'+id).remove();
                affiche_status("successfully deleted");
            });
        }
        //show
        function EditTrailer(id) {
            $.get("/trailer/" + id + "/show", function (data) {
                if (data != null) {
                    let active = data.active == 1 ? "true" : "false";
                    if (active == "true")
                        $("#edit_Trailer #active").attr("checked", "checked");
                    else
                        $("#edit_Trailer #active").removeAttr("checked");;
                    $("#edit_Trailer #id").val(data.id);
                    $("#edit_Trailer #numero").val(data.numero);
                    $("#edit_Trailer #trailertype_id").val(data.trailer);
                    $("#edit_Trailer #v").val(data.volum),
                    $("#edit_Trailer").modal("show");
                }
            });
        }
        //trailer type
    //add
        $("#add_trailertype form").on("submit", function (e) {
            e.preventDefault();
            Access_ajax(
                $("#add_trailertype form")[0],
                $("#add_trailertype"),
                "/trailer-type",
                {
                    name: $("#add_trailertype #name").val(),
                    active:$("#add_trailertype #active").val() == "true" ? 1 : 0,
                },
                "add_trailertype"
            );
        });
        //edit
        $("#edit_trailertype form").on("submit", function (e) {
            e.preventDefault();
            Access_ajax(
                $("#edit_trailertype form")[0],
                $("#edit_trailertype"),
                "/trailer-type/update",
                {
                    id: $("#edit_trailertype #id").val(),
                    name: $("#edit_trailertype #name").val(),
                    active:$("#edit_trailertype #active").val() == "true" ? 1 : 0,
                },
                "edit_trailertype"
            );
        });
        //Delete
        function DeleteTrailerType(id) {
            $.get("/trailer-type/delete/" + id, function (data) {
                if(data==1)
                $('#TT_'+id).remove();
                affiche_status("successfully deleted");
            });
        }
        //show
        /*async*/ function EditTrailerType(id) {
            /*let response=await axios.get("/trailer-type/" + id + "/show");

                console.log(response.data);*/

            $.get("/trailer-type/" + id + "/show", function (data) {
                if (data != null) {
                    let active = data.active == 1 ? "true" : "false";
                    if (active == "true")
                        $("#edit_trailertype #active").attr("checked", "checked");
                        else
                    $("#edit_trailertype #active").removeAttr("checked");

                    $("#edit_trailertype #id").val(data.id);
                    $("#edit_trailertype #name").val(data.name);
                    $("#edit_trailertype #active").val(active);
                    $("#edit_trailertype").modal("show");
                }
            });
        }
//

//close modal
let btn=document.querySelectorAll('.btn-close');

btn.forEach(element => {
    element.addEventListener('click',function(){
        let div=this.parentElement.parentElement.parentElement.parentElement.getAttribute('id');
        document.querySelector('#'+div+' form').reset();
    })
});

//search city

let rgx=/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u;
$('#search_city').on('keyup',function(){
    let select=rgx.test($(this).val())==true?$(this).val():'Etoile';
    $.getJSON('/city/search/'+select,function(data){
        if(select=='Etoile'){
            $('#tb_city').html('');
            let values=data.data;
            $.each(values,function(key,value){
                let active = value.active == 1 ? "checked" : "";
                $('#tb_city').append(
                    '<tr id="city_'+value.id+'"><td>'+value.id+
                    '</td><td>'+value.name+
                    '</td><td>'+value.position+
                    '</td><td><input type="checkbox" id="toggle-two" '+active+'  data-toggle="toggle" data-size="sm" data-onstyle="outline-success" data-offstyle="outline-danger" data-on="Yes" data-off="No"></td><td><a class="btn btn-danger" onclick="DeleteCity('+value.id+
                    ')"><i class="fa-solid fa-trash-can"></i></a></td></tr>');
                });
            }else{
            $('#tb_city').html('');
        $.each(data,function(key,value){
            let active = value.active == 1 ? "checked" : "";
            $('#tb_city').append(
                '<tr id="city_'+value.id+'"><td>'+value.id+
                '</td><td>'+value.name+
                '</td><td>'+value.position+
                '</td><td><input type="checkbox" id="toggle-two" '+active+'  data-toggle="toggle" data-size="sm" data-onstyle="outline-success" data-offstyle="outline-danger" data-on="Yes" data-off="No"></td><td><a class="btn btn-danger" onclick="DeleteCity('+value.id+
                ')"><i class="fa-solid fa-trash-can"></i></a></td></tr>');
        });
    }
    toggleCheck();
    });
});

toggleCheck();
function toggleCheck(){
    $.each($('#toggle-two'),function(key,vaue){
        $('#toggle-two').bootstrapToggle({});
    })
}


function changeToggle(id){
    //btn-outline-danger off
    //btn-outline-success
    let toggleInput=$('#city_'+id+' td:nth-child(4) div');
    let active=1;
    if(toggleInput.hasClass('off'))
    active=0
    $.get('/city/edit/'+id+'/'+active,function(data){
        active=active==1?'active':'not active';
        if(data)
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Successfully updated the city '+active,
            showConfirmButton: false,
            timer: 1500
          })
    })
}



