<script>
{literal}
$('.box-body').hide();

    $(".btn-info").click(function(){
        var name = $(this).attr("data-name");
        $('.'+name).toggle('1000');
        $("i", this).toggleClass("fa fa-plus fa fa-minus");
	});

    // Toggle attribute
    $(".btn-info").attr('title', 'Show').click(function() {
            $(this).toggleClass('checked');
            var title = 'Show';
            if( $(this).hasClass('checked')){
                title = 'Hide';
            }
            $(this).attr('title', title);
        });
{/literal}
</script>