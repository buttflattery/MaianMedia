
	jQuery.noConflict();
	var dataView;
	var grid;
	var dataset = [];
	var columns = [ {
		id : "name",
		name : "{name}",
		field : "name",
		width : 180,
		minWidth : 180,
		maxWidth : 180,
		cssClass : "slick-center",
		resizable : false,
		formatter : maianFormatter,
		sortable : true
	}, {
		id : "published",
		name : "{published}",
		field : "published",
		formatter : maianFormatter,
		width : 120,
		minWidth : 120,
		maxWidth : 120,
		resizable : false,
		cssClass : "slick-published",
		sortable : false
	}, {
		id : "categories",
		name : "{categories}",
		field : "categories",
		width : 120,
		minWidth : 120,
		maxWidth : 120,
		resizable : false,
		cssClass : "slick-center",
		sortable : false
	},{
		id : "upc",
		name : "{upc}",
		field : "upc",
		width : 120,
		minWidth : 120,
		maxWidth : 120,
		resizable : false,
		cssClass : "slick-center",
		sortable : false
	}, {
		id : "price",
		name : "{price}",
		field : "price",
		width : 185,
		minWidth : 185,
		maxWidth : 185,
		resizable : false,
		cssClass : "slick-center",
		sortable : false
	}, {
		id : "hits",
		name : "{hits}",
		field : "hits",
		minWidth : 180,
		maxWidth : 180,
		width : 180,
		formatter : maianFormatter,
		cssClass : "slick-center",
		sortable : false
	}, {
		id : "discount",
		name : "{discount}",
		field : "discount",
		minWidth : 100,
		width : 100,
		maxWidth : 100,
		cssClass : "slick-center",
		sortable : false
	}, {
		id : "remove",
		name : "",
		field : "remove_record",
		minWidth : 40,
		width : 40,
		maxWidth : 40,
		formatter : maianFormatter,
		cssClass : "slick-center",
		sortable : false
	}, {
		id : "status",
		name : "",
		field : "status",
		minWidth : 1,
		width : 1,
		maxWidth : 1,
		formatter : maianFormatter,
		cssClass : "slick-hidden",
		sortable : false
	}];

	var options = {
		editable : false,
		rowHeight : 40,
		enableAddRow : false,
		topPanelHeight : 125,
		enableCellNavigation : true,
		asyncEditorLoading : true,
		forceFitColumns : false
	};

	var sortcol = "name";
	var sortdir = 1;
	var itemName = "";

	var dates = {
		convert : function(d) {
			// Converts the date in d to a date-object. The input can be:
			// a date object: returned without modification
			// an array : Interpreted as [year,month,day]. NOTE: month is 0-11.
			// a number : Interpreted as number of milliseconds
			// since 1 Jan 1970 (a timestamp)
			// a string : Any format supported by the javascript engine, like
			// "YYYY/MM/DD", "MM/DD/YYYY", "Jan 31 2009" etc.
			// an object : Interpreted as an object with year, month and date
			// attributes. **NOTE** month is 0-11.
			return (d.constructor === Date ? d
					: d.constructor === Array ? new Date(d[0], d[1], d[2])
							: d.constructor === Number ? new Date(d)
									: d.constructor === String ? new Date(d)
											: typeof d === "object" ? new Date(
													d.year, d.month, d.date)
													: NaN);
		},
		compare : function(a, b) {
			// Compare two dates (could be of any type supported by the convert
			// function above) and returns:
			// -1 : if a
			// _$tag____________________________________________________ b
			// NaN : if a or b is an illegal date
			// NOTE: The code inside isFinite does an assignment (=).
			return (isFinite(a = this.convert(a).valueOf())
					&& isFinite(b = this.convert(b).valueOf()) ? (a > b)
					- (a < b) : NaN);
		},
		inRange : function(d, start, end) {
			// Checks if date in d is between dates in start and end.
			// Returns a boolean or NaN:
			// true : if d is between start and end (inclusive)
			// false : if d is before start or after end
			// NaN : if one or more of the dates is illegal.
			// NOTE: The code inside isFinite does an assignment (=).
			return (isFinite(d = this.convert(d).valueOf())
					&& isFinite(start = this.convert(start).valueOf())
					&& isFinite(end = this.convert(end).valueOf()) ? start <= d
					&& d <= end : NaN);
		}
	}

	function myFilter(item, args) {

		if (args.custName != "") {
			var start = item["name"].indexOf(">") + 1;
			var end = item["name"].indexOf("</");
			var name = item["name"].substring(start, end);
			
			if (item["name"].substring(start, end).toUpperCase().indexOf(args.itemName.toUpperCase()) == -1) {
				return false;
			}
		}
		
		return true;
	}

	function maianFormatter(row, cell, value, columnDef, dataContext) {
		return value;
	}

	function comparer(a, b) {
		var x = a[sortcol], y = b[sortcol];
		return (x == y ? 0 : (x > y ? 1 : -1));
	}

	function toggleFilterRow() {
		if (jQuery(grid.getTopPanel()).is(":visible")) {
			grid.hideTopPanel();
		} else {
			grid.showTopPanel();
		}
	}

	jQuery(".grid-header .ui-icon").addClass("ui-state-default ui-corner-all")
			.mouseover(function(e) {
				jQuery(e.target).addClass("ui-state-hover")
			}).mouseout(function(e) {
				jQuery(e.target).removeClass("ui-state-hover")
			});

	jQuery(function() {

		dataView = new Slick.Data.DataView( {
			inlineFilters : true
		});

		jQuery.getJSON(
						"{url}index.php?option=com_maianmedia&controller=items&format=raw&task=getdata",
						function(data) {
							// called whenever the server gets around to sending
							dataView.beginUpdate();
							dataView.setItems(data);
							dataView.setFilterArgs( {
								itemName : itemName
							});
							dataView.setFilter(myFilter);
							dataView.endUpdate();
							dataset = data;
						});

		grid = new Slick.Grid("#myGrid", dataView, columns, options);
		grid.setSelectionModel(new Slick.RowSelectionModel());

		var pager = new Slick.Controls.Pager(dataView, grid, jQuery("#pager"));
		var columnpicker = new Slick.Controls.ColumnPicker(columns, grid, options);

		// move the filter panel defined in a hidden div into grid top panel
		jQuery("#inlineFilterPanel").appendTo(grid.getTopPanel()).show();

		grid.onCellChange.subscribe(function(e, args) {
			dataView.updateItem(args.item.id, args.item);
		});

		grid.onKeyDown.subscribe(function(e) {
			// select all rows on ctrl-a
			if (e.which != 65 || !e.ctrlKey) {
				return false;
			}

			var rows = [];
			for ( var i = 0; i < dataView.getLength(); i++) {
				rows.push(i);
			}

			grid.setSelectedRows(rows);
			e.preventDefault();
		});

		grid.onSort.subscribe(function(e, args) {
			sortdir = args.sortAsc ? 1 : -1;
			sortcol = args.sortCol.field;

			if (jQuery.browser.msie && jQuery.browser.version <= 8) {
				// using temporary Object.prototype.toString override
				// more limited and does lexicographic sort only by default, but
				// can be
				// much faster

			} else {
				// using native sort with comparer
				// preferred method but can be very slow in IE with huge
				// datasets
				dataView.sort(comparer, args.sortAsc);
			}
		});

		// wire up model events to drive the grid
		dataView.onRowCountChanged.subscribe(function(e, args) {
			grid.updateRowCount();
			grid.render();
		});

		grid.onClick.subscribe(function (e) {
		      var cell = grid.getCellFromEvent(e);
		      var column = new String(grid.getColumns()[cell.cell].id);

		      if (grid.getColumns()[cell.cell].id == "published") {

		    	  jQuery.ajax({
		    	        url: "{url}index.php?option=com_maianmedia&controller=items&format=raw&task=change_state",
		    	        type: "post",
		    	        data : { item_id:dataset[cell.row].id,
		    	        		published: dataset[cell.row].status},
		    	        // callback handler that will be called on success
		    	        success: function(response, textStatus, jqXHR){
		    	            // log a message to the console
		    	            console.log("Hooray, it worked!");
		    	        },
		    	        // callback handler that will be called on error
		    	        error: function(jqXHR, textStatus, errorThrown){
		    	            // log the error to the console
		    	            console.log(
		    	                "The following error occured: "+
		    	                textStatus, errorThrown
		    	            );
		    	        },
		    	        // callback handler that will be called on completion
		    	        // which means, either on success or error
		    	        complete: function(result){
		    	            // enable the inputs
		    	        	console.log(result);
		    	        	var data = jQuery.parseJSON(result.responseText);

		    	        	dataset[cell.row].published= data.link;
		    	        	dataset[cell.row].status = data.status;
		    	        	
		    	        	grid.updateRow(cell.row);
		    	            e.stopPropagation();
		    	        }
		    	    });

		      }
		    });
		
		dataView.onRowsChanged.subscribe(function(e, args) {
			grid.invalidateRows(args.rows);
			grid.render();
		});

		dataView.onPagingInfoChanged.subscribe(function(e, pagingInfo) {
			var isLastPage = pagingInfo.pageNum == pagingInfo.totalPages - 1;
			var enableAddRow = isLastPage || pagingInfo.pageSize == 0;
			var options = grid.getOptions();
		});

		var h_runfilters = null;

		// wire up the search textbox to apply the filter to the model

		jQuery("#name").keyup(function(e) {
			Slick.GlobalEditorLock.cancelCurrentEdit();

			// clear on Esc
			if (e.which == 27) {
				this.value = "";
			}

			itemName = this.value;
			updateFilter();
		});


		function updateFilter() {
			dataView.setFilterArgs( {
				itemName : itemName
			});
			dataView.refresh();
		}
		
		// if you don't want the items that are not visible (due to being
		// filtered
		// out
		// or being on a different page) to stay selected, pass 'false' to the
		// second arg
		dataView.syncGridSelection(grid, true);

		jQuery("#gridContainer").resizable();
	})

	function removeItem(id, message, yes, no) {
		var answer = confirm(message, yes, no);
		if (answer) {
			dataView.deleteItem(id);
		}
	}
