$(function ()
{
    var id = $('#show_billets_form_id').val();
    $('#delete_billets').attr('href',"/delete/" + id );
    $('.billet-content:even').css('background-color', '#0769AD').css('color', '#fff');
    $('.billet-content:odd').css('background-color', '#595959').css('color', '#fff');
});


