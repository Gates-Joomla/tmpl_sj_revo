/**
 * Event - Subsidiary products components.
 * @param el
 * @constructor
 */
function ChildProdShow(el) {
    var $ = jQuery ;
    var $el = $(el);
    var car_id = $el.data('cat_id');
    var $itemBlock = $('#item-child');

    $el.closest('#tabs-child').children().removeClass('select_tab');
    $el.addClass('select_tab');
    $itemBlock.children().addClass('hidden');
    $itemBlock.find('[data-catid="'+car_id+'"]').removeClass('hidden')
}
/**
 * Events ask a question about the product.
 * @param event
 * @param el
 */
function askQuestionEvent( event , el) {
    event.preventDefault() ;
    var $ = jQuery ;
    var $el = $(el);
    gnz11.__loadModul.Fancybox().then(function (Fancybox) {
        Fancybox.open({
            type : 'iframe',
            iframe : {
                css : {
                    width : '600px'
                }
            },
            src :$el.attr('href')
        });
    });
}


