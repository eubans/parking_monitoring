/*!
 * Print button for Buttons and DataTables.
 * 2016 SpryMedia Ltd - datatables.net/license
 */

(function( factory ){
	if ( typeof define === 'function' && define.amd ) {
		// AMD
		define( ['jquery', 'datatables.net', 'datatables.net-buttons'], function ( $ ) {
			return factory( $, window, document );
		} );
	}
	else if ( typeof exports === 'object' ) {
		// CommonJS
		module.exports = function (root, $) {
			if ( ! root ) {
				root = window;
			}

			if ( ! $ || ! $.fn.dataTable ) {
				$ = require('datatables.net')(root, $).$;
			}

			if ( ! $.fn.dataTable.Buttons ) {
				require('datatables.net-buttons')(root, $);
			}

			return factory( $, root, root.document );
		};
	}
	else {
		// Browser
		factory( jQuery, window, document );
	}
}(function( $, window, document, undefined ) {
'use strict';
var DataTable = $.fn.dataTable;


var _link = document.createElement( 'a' );

/**
 * Clone link and style tags, taking into account the need to change the source
 * path.
 *
 * @param  {node}     el Element to convert
 */
var _styleToAbs = function( el ) {
	var url;
	var clone = $(el).clone()[0];
	var linkHost;

	if ( clone.nodeName.toLowerCase() === 'link' ) {
		clone.href = _relToAbs( clone.href );
	}

	return clone.outerHTML;
};

/**
 * Convert a URL from a relative to an absolute address so it will work
 * correctly in the popup window which has no base URL.
 *
 * @param  {string} href URL
 */
var _relToAbs = function( href ) {
	// Assign to a link on the original page so the browser will do all the
	// hard work of figuring out where the file actually is
	_link.href = href;
	var linkHost = _link.host;

	// IE doesn't have a trailing slash on the host
	// Chrome has it on the pathname
	if ( linkHost.indexOf('/') === -1 && _link.pathname.indexOf('/') !== 0) {
		linkHost += '/';
	}

	return _link.protocol+"//"+linkHost+_link.pathname+_link.search;
};


DataTable.ext.buttons.print = {
	className: 'buttons-print',

	text: function ( dt ) {
		return dt.i18n( 'buttons.print', 'Print' );
	},

	action: function ( e, dt, button, config ) {

		var has_child_rows = true;

	    var data = dt.buttons.exportData(
            $.extend( {decodeEntities: false}, config.exportOptions ) // XSS protection
        );

	    var addRow = function ( d, tag, child_row ) {
	        var str = '<tr>';

	        // Dynamic data allocation for table with or without child rows - [Ryan]
	        for ( var i = 0, ien = d.length; i < ien; i++ ) {
	            if (has_child_rows && ! child_row && i === 0) continue;

				if(typeof d.prevObject !== 'undefined' && d.prevObject[i].colSpan === 4 && d[i] !== "") {

					str  += '<' + tag + ' style="word-wrap: break-word" '+
							'colspan='+d.prevObject[i].colSpan+'>' + d[i] + '</' + tag + '>';
				}else {

					if(tag === "th" &&  d[i] === ""){
						str += '<' + tag + ' style="width: fit-content;">' + d[i] + '</' + tag + '>';
					} else {
						str += '<' + tag + '>' + d[i] + '</' + tag + '>';
					}
				}
			}

	        return str + '</tr>';
	    };

	    var addSubTable = function ( subtable, colspan ) {

	        var str = '<tr class="innertable-row">'
	                +     '<td class="innertable-row" colspan="' + colspan + '">';

	        // If there is no subtable, there must be other child row content, display that
	        if ( subtable.length == 0 ) {
	            str += '<div style="text-align: left">'
	            str += $( dt.row( row_idx ).child() ).children().children().html();
	            return str + '<div></td></tr>';
	        }

	        // Add header row
	        var headers = subtable.find('tr').first().find('th,td');

	        str += '<table style="font-size: 10pt; table-layout: fixed; width:100%;" class="dataTable no-footer">'
	            +    '<thead><tr>';

	        for ( var i = 0; i < headers.length; i++ ) {
				if(headers.eq(i).text() === ""){
					str += '<th style="width: fit-content;">' + headers.eq(i).text() + '</th>';
				} else{
					str += '<th>' + headers.eq(i).text() + '</th>';
				}
			}

	        str += '</tr></thead><tbody>';

	        // Add body rows
	        subtable.find('tbody').children('tr').each(function(index, tr) {
	            var lines = $('td', tr).map(function(index, td) {
	                return $(td).text();
	            });
	            str += addRow( lines, 'td', true );
	        });

	        return str + '</tbody></table></td></tr>';
	    };

	    // Construct a table for printing
	    var html = '<table style="font-size: 10pt; table-layout: fixed; width:100%;" class="' + dt.table().node().className + '">';

	    if ( config.header ) {
			(data.header).push(""); // Fix for uneven column
	        html += '<thead>' + addRow( data.header, 'th' ) + '</thead>';
	    }

	    html += '<tbody>';
	    for ( var i = 0, ien = data.body.length; i < ien; i++ ) {
	        html += addRow( data.body[i], 'td' );

	        if ( has_child_rows ) {
	            var row_idx = data.body[i][0];
	            if ( dt.row( row_idx ).child() && dt.row( row_idx ).child.isShown() ) {
	                html += addSubTable( $( dt.row( row_idx ).child() ).find( 'table:visible' ), data.body[0].length );
	            }
	        }
	    }
	    html += '</tbody>';

	    if ( config.footer && data.footer ) {
	        html += '<tfoot>' + addRow( data.footer, 'th' ) +'</tfoot>';
	    }

	    // Open a new window for the printable table
	    var win = window.open();
	    var title = config.title;

	    if ( typeof title === 'function' ) {
	        title = title();
	    }

	    if ( title.indexOf( '*' ) !== -1 ) {
	        title = title.replace( '*', $('title').text() );
	    }

	    win.document.close();

	    // Inject the title and also a copy of the style and link tags from this
	    // document so the table can retain its base styling. Note that we have
	    // to use string manipulation as IE won't allow elements to be created
	    // in the host document and then appended to the new window.
	    var head = '<title>'+title+'</title>';
	    $('style, link').each( function() {
	        head += _styleToAbs( this );
	    });

	    try {
	        win.document.head.innerHTML = head; // Work around for Edge
	    }
	    catch (e) {
	        $( win.document.head ).html( head ); // Old IE
	    }

	    // Incase config message is undefined
	 	var msg =  "";
	 	if((typeof config.message === 'function' ?
	                config.message( dt, button, config ) :
	                config.message
	             )!==undefined){
	 		msg = (typeof config.message === 'function' ?
	                config.message( dt, button, config ) :
	                config.message
	             );
	 	}
	    // Inject the table and other surrounding information
	    win.document.body.innerHTML =
	          '<h1>' + title + '</h1>'
	        + '<div>'
	        +    msg
	        + '</div>'
	        + html;

	    $( win.document.body ).addClass('dt-print-view');

	    $('img', win.document.body).each( function ( i, img ) {
	        img.setAttribute( 'src', _relToAbs( img.getAttribute('src') ));
	    });

	    if ( config.customize ) {
	        config.customize( win );
	    }

	    setTimeout( function() {
	        if ( config.autoPrint ) {
	            win.print();
	            win.close();
	        }
	    }, 1000 );
	},

	title: '*',

	messageTop: '*',

	messageBottom: '*',

	exportOptions: {},

	header: true,

	footer: false,

	autoPrint: true,

	customize: null
};


return DataTable.Buttons;
}));
