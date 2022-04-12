import "../css/app.scss";

$(document).ready(function() {
    // Get the ul that holds the collection of tags

    $('.add-item').on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        let $this = $(this);
        let type = $this.data('type');
        $collectionHolder = $('ul.' + type);
        
        // add a new tag form (see code block below)
        addTagForm($collectionHolder, $this);
    });
    
    $(document).on('click', '.remove-tag', function(e) {
        e.preventDefault();
        
        $(this).parent().remove();
        
        return false;
    });
    
});