var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType,
    blockStyle = { backgroundColor: '#07548E', color: '#fff', padding: '20px' };

registerBlockType( 'photo-contest/block', {
    title: 'Photo Contest',

    icon: 'images-alt',

    category: 'widgets',

    edit: function() {
        return el( 'p', { style: blockStyle }, 'Photo Contest Block' );
    },

    save: function() {
        return el( '', '', '[contest-menu][contest-page]' );
    },
} );
