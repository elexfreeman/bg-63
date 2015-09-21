function AddToCard(product_id)
{
    console.info("AddToCard="+product_id);
    $.get(
        "ajax.html",
        {
            //log1:1,
            action:"AddToCard",
            product_id:product_id,
            product_count:1
        },
        function (data) {
            console.info(data);
            if(data.status=="1")
            {

                $(".ProductCountText").html(data.panel_text);
            }

        },"json"
    ); //$.get  END
}

//Поиск товаров
function Search()
{
    $('.sphere').each(function(i,elem) {
        //console.info($(elem).text(),i);
        if ($(elem).hasClass("active"))
        {
            console.info($(elem).html(),i);
        }
    });



}
