/* jquery.masterblaster v.0.1.0
 * A nice and tidy tag manager.
 * by aef
 */
( function( $, window, document, undefined ) {
  var pluginName = "materials",
      name = "plugin_masterblaster",
      defaults = { 
        animate: true,
        triggerKeys: [ 9, 13 ], //keycode when entered adds the tag
        showAddButton: true,
        helpText: "Maximum 15 Materials allowed.",
        validateOnChange: true,
        tagRules: {
          unique: true,
          minLength: null,
          maxLength: 15,
          regexp: null
        },
      },
      methods = [ "push", "pop", "remove", "destroy" ],
      methodsWithReturn = [ "getTags" ];

  function Materials( $element, options ) {
    this.options = $.extend( {}, defaults, options );
    this.$container = $( '<div class="mb-container"></div>' );
    this.$tagList = $( '<ul class="mb-taglist"></ul>' );
    this.$meta = $( '<div class="mb-meta"></div>' );
    this.$element = $element;
    this.$oldInput = $element;
    this.$input = $element.clone( );
    if( this.options.showAddButton )
      this.$addButton = $( "<button class='btn mb-add-button'><i class='icon-plus'></i>Add</button>" );
    this.tag = [ '<li style="opacity:1" data-tag="" class="mb-tag tags"><div class="mb-tag-content">',
                  '<input type="hidden" class="inputtxt" name="materials[]" value="" />',
                  '<span class="mb-tag-text"></span>',
                  '<a class="mb-tag-remove"></a>',
                 '</div></li>' ].join( "" );
    this.tags = [ ];

    this.setup( );
  }

  Materials.prototype.addElem = function( $tag ) {
    if( this.options.animate ) {
      $tag.css( "opacity", 0 );
      $tag.insertBefore( this.$meta );
      var width = $tag.css( "width" );
      $tag.css( "width", 0 );
      $tag.animate( {
        width: width
      }, "fast", function( ) {
       $tag.css( "width", "" );
       $tag.animate( { opacity: 1 } ); 
      } );
    }
    else
      $tag.insertBefore( this.$meta );
  };

  Materials.prototype.buildTag = function( tagName ) {
    var $tag = $( this.tag );
    $tag.find( ".inputtxt" ).val( tagName );
    $tag.find( ".mb-tag-text" ).text( tagName );
    $tag.attr( "data-tag", tagName );

    return $tag;
  };

  Materials.prototype.removeEvents = function( ) {
    this.$input.on( "keyup", $.proxy( this.onRemove, this ) );
    if( this.options.showAddButton )
      this.$addButton.on( "click", $.proxy( this.onRemove, this ) );
  };

  Materials.prototype.addEvents = function( ) {
    this.$input.on( "keyup", $.proxy( this.onAdd, this ) );
    if( this.options.showAddButton )
      this.$addButton.on( "click", $.proxy( this.onAdd, this ) );
  };

  Materials.prototype.onAdd = function( e ) {
    var isBeingSaved = false, tagName = this.cleanTag( this.$input.val( ) );
    if( e.type === "click" || ~this.options.triggerKeys.indexOf( e.keyCode || e.which ) ) {
      e.preventDefault( );
      isBeingSaved = true;
    }
    if( this.isValid( tagName, isBeingSaved ) ) {
      this.$container.removeClass( "mb-error" );
      if( isBeingSaved ) {
        this.push( tagName );
        this.$input.val( "" );
      }
    } else if( isBeingSaved || this.options.validateOnChange ) {
      this.$container.addClass( "mb-error" );
      this.$element.trigger( "mb:error", tagName, this.error );
    }
  };

  Materials.prototype.cleanTag = function( tagName ) {
    return tagName;
  };

  Materials.prototype.isValid = function( tagName, isBeingSaved ) {
    if( this.options.tagRules.unique && this.hasTag( tagName ) ) {
      this.error = tagName + " already exists.";
      return false;
    } else if( this.options.tagRules.minLength && tagName.length < this.options.tagRules.minLength ) {
      this.error = tagName + " must be greater than " + this.options.tagRules.minLength + " characters.";
      return false;
    } else if( this.options.tagRules.maxLength && tagName.length > this.options.tagRules.maxLength ) {
      this.error = tagName + " must have fewer than " + this.options.tagRules.maxLength + " characters.";
      return false;
    } else if( this.options.tagRules.regexp && !this.options.tagRules.regexp.test( tagName ) ) {
      this.error = tagName + " is not in the valid format.";
      return false;
    }
    return true;
  };

  Materials.prototype.refreshTagEvents = function( ) {
    this.$tagList.find( ".mb-tag-remove" ).off( "click" );
    this.$tagList.find( ".mb-tag-remove" ).on( "click", $.proxy( this.onRemove, this ) );
  };

  Materials.prototype.onRemove = function( e ) {
    e.preventDefault( );
    this.remove( $( e.target ).parents( ".mb-tag" ).attr( "data-tag" ) );
  };
 
  Materials.prototype.removeElem = function( tagName ) {
    var $tag = this.$tagList.find( "[data-tag='"+tagName+"']" );
    if( this.options.animate ) {
      $tag.animate( { opacity: 0.01 }, "fast", function( ) {
        $tag.animate( { width: 0, margin: 0 }, "fast", function( ) {
          $tag.remove( );
        } );
      } );
    }
    else
      $tag.remove( ); 
  };

  Materials.prototype.hasTag = function( tagName ) {
    return ~( this.tags.indexOf( tagName ) ); 
  };

  Materials.prototype.push = function( tagName ) {
    this.tags.push( tagName );

    this.addElem( this.buildTag( tagName ) );
    this.refreshTagEvents( );

    this.$element.trigger( "mb:add", tagName );
  };

  Materials.prototype.pop = function( ) {
    var tagName = this.tags[ this.tags.length - 1 ];
    this.remove( tagName );
  };

  Materials.prototype.removeFromTagsArray = function( tagName ) {
    var index = this.tags.indexOf( tagName );
    if( !~index ) return false;
    this.tags.splice( index, 1 );
    return true;
  };

  Materials.prototype.remove = function( tagName ) {
    this.removeElem( tagName );
    while( this.removeFromTagsArray( tagName ) );
    this.$element.trigger( "mb:remove", tagName );
  };

  Materials.prototype.destroy = function( ) {
    this.$oldInput.show( );
    this.removeEvents( );
    this.$container.remove( );
    this.$element.removeData( name );
  };

  Materials.prototype.getTags = function( ) {
    return $.merge( [ ], this.tags );
  };

  Materials.prototype.setup = function( ) {
    this.$container.insertAfter( this.$oldInput );
    this.$oldInput.hide( );
    this.$input.attr( "id", "" ).addClass( "mb-input" );
    this.$container.append( this.$tagList.append( this.$meta ) );
    this.$meta.append( this.$input );

    if( this.options.showAddButton )
      this.$input.after( this.$addButton );

    if( this.options.helpText )
      this.$meta.append( "<span class='mb-help-text'><small>"+this.options.helpText+"</small></span>" );

    this.addEvents( );
  };

  $.fn[ pluginName ] = function( optionsOrMethod ) {
    var $this,
        _arguments = Array.prototype.slice.call( arguments ),
        optionsOrMethod = optionsOrMethod || { },
        results = [ ], returningData = false, selectors;

    selectors = this.each(function ( ) {
      $this = $( this );
      if( !$this.data( name ) && ( typeof optionsOrMethod ).toLowerCase( ) === "object" ) 
        $this.data( name, new Materials( $this, optionsOrMethod ) );
      else if( ( typeof optionsOrMethod ).toLowerCase( ) === "string" ) {
        if( ~$.inArray( optionsOrMethod, methods ) )
          $this.data( name )[ optionsOrMethod ].apply( $this.data( name ), _arguments.slice( 1, _arguments.length ) );
        else if( ~$.inArray( optionsOrMethod, methodsWithReturn ) ) {
          returningData = true;
          results.push( $this.data( name )[ optionsOrMethod ].apply( $this.data( name ), _arguments.slice( 1, _arguments.length ) ) );
        }
        else
          throw new Error( "Method " + optionsOrMethod + " does not exist. Did you instantiate materials?" );
      }
    } );

    return returningData ? results : selectors;
  };
} )( jQuery, window, document );
