"use strict";
$(document).ready(function () {

    $('#ay').inputmask('9999-9999', {
        placeholder: 'yyyy-yyyy'
    });


    // $('.overlay').hide();

    window.openSearchStudent = function () {

        $(".modal-title").html('Search Student');

        $.ajax({
            url: '/student/search/form',
            async: false,
            data: {

            },
            success: function (data) {

                $('#extralargemodal_body').html(data);

                setTimeout(
                    function () {
                        $("#search_student").focus();
                    }, 500);

            },
            dataType: 'HTML'
        });

    }

    window.clickStudent = function (id) {
        // document.getElementById('student-details').style.display = 'block';
        $.ajax({
            url: '/student/get',
            async: false,
            data:{
                id: id,
            },
            success: function (data) {

                var len = data.length;

                for(var i=0; i<len; i++){

                   $("#Id_num").val(data[i].Id_num);
                   $("#name").val(data[i].name);
                   $("#lvl").val(data[i].lvl);
                   $("#section").val(data[i].section);
                   $("#ay").val(data[i].ay);
                   $("#phonenumber").val(data[i].phonenumber);
                   $("#reg_fee").val(data[i].registration_fee);
                   $("#tui_fee").val(data[i].tuition_fee);
                   $("#uni_fee").val(data[i].uniform_fee);
                   $("#Medical").val(data[i].Medical);
                   $("#Insurance").val(data[i].Insurance);
                   $("#Death").val(data[i].Death);
                   $("#Library").val(data[i].Library);
                   $("#School_Pub").val(data[i].School_Pub);
                   $("#Athlet").val(data[i].Athlet);
                   $("#BACS").val(data[i].BACS);
                   $("#Book").val(data[i].Book);
                   $("#Laboratory").val(data[i].Laboratory);
                   $("#StudentID").val(data[i].StudentID);
                   $("#Passbook").val(data[i].Passbook);
                   $("#Handbook").val(data[i].Handbook);
                   $("#Dental").val(data[i].Dental);
                   $("#Completers_Fee").val(data[i].Completers_Fee);
                   $("#graduation").val(data[i].Graduation_Fee);
                }

                $('#ExtralargeModal').modal('toggle');

            },
            dataType: 'JSON'
        });

    }

    window.searchStudent = function () {

        if ($('#search_student').val().length >= 2) {

            var string = $('#search_student').val();

            $.ajax({
                url: '/student/search',
                async: false,
                data: {
                    keyword: string,

                },
                success: function (data) {

                    //  $('.trresult').remove();

                    $('#empdata_body').html(data);

                },
                dataType: 'html'
            });

        }

    }

});
