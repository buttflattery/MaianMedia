	jQuery.noConflict();
	var dataView;
	var grid;
	var data = [];
	var columns = [ {
		id : "customer",
		name : "{customer_title}",
		field : "customer",
		width : 280,
		minWidth : 280,
		maxWidth : 280,
		cssClass : "slick-center",
		formatter : maianFormatter,
		sortable : true
	}, {
		id : "items",
		name : "{items_title}",
		field : "items",
		formatter : maianFormatter,
		width : 280,
		minWidth : 280,
		maxWidth : 280,
		cssClass : "slick-center",
		sortable : false
	}, {
		id : "sales",
		name : "{sales_title}",
		field : "sales",
		width : 185,
		minWidth : 185,
		maxWidth : 185,
		resizable : false,
		formatter : maianFormatter,
		cssClass : "slick-center",
		sortable : false
	}, {
		id : "sales_details",
		name : "{sales_details}",
		field : "sales_details",
		minWidth : 180,
		maxWidth : 180,
		width : 180,
		formatter : maianFormatter,
		cssClass : "slick-center",
		sortable : false
	}, {
		id : "contact_details",
		name : "{contact_details}",
		field : "contact_details",
		minWidth : 180,
		width : 180,
		formatter : maianFormatter,
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
		id : "email",
		name : "",
		field : "email",
		minWidth : 1,
		width : 1,
		maxWidth : 1,
		cssClass : "slick-hidden",
		sortable : false
	}, {
		id : "invoice",
		name : "",
		field : "invoice",
		minWidth : 1,
		width : 1,
		maxWidth : 0,
		cssClass : "slick-hidden",
		sortable : false
	}, {
		id : "trans",
		name : "",
		field : "trans",
		minWidth : 1,
		width : 1,
		maxWidth : 1,
		cssClass : "slick-hidden",
		sortable : false
	}, {
		id : "pay_date",
		name : "",
		field : "pay_date",
		minWidth : 1,
		width : 1,
		maxWidth : 1,
		cssClass : "slick-hidden",
		sortable : false
	}, {
		id : "active_cart",
		name : "",
		field : "active_cart",
		minWidth : 1,
		width : 1,
		maxWidth : 1,
		cssClass : "slick-hidden",
		sortable : false
	} ];

	var options = {
		editable : false,
		rowHeight : 40,
		enableAddRow : false,
		topPanelHeight : 125,
		enableCellNavigation : true,
		asyncEditorLoading : true,
		forceFitColumns : false
	};

	var sortcol = "customer";
	var sortdir = 1;
	var custName = "";
	var email = "";
	var invoice = "";
	var txn_id = "";
	var start_date = "";
	var end_date = "";
	var active_cart_search = "1";

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
			var start = item["customer"].indexOf("_$t") + 3;
			var end = item["customer"].indexOf("_$ta");

			if (item["customer"].substring(start, end).toUpperCase().indexOf(args.custName.toUpperCase()) == -1) {
				return false;
			}
		}

		if (args.email != "" && item["email"].toUpperCase().indexOf(args.email.toUpperCase()) == -1) {
			return false;
		}

		if (args.invoice != "" && item["invoice"].toUpperCase().indexOf(args.invoice.toUpperCase()) == -1) {
			return false;
		}

		if (args.txn_id != "" && item["trans"].toUpperCase().indexOf(args.txn_id.toUpperCase()) == -1) {
			return false;
		}

		if (args.active_cart_search != "" && item["active_cart"].toUpperCase().indexOf(args.active_cart_search.toUpperCase()) == -1) {
			return false;
		}
		
		if (args.start_date != "" && args.end_date == "" && dates.compare(args.start_date, item["pay_date"]) == -1) {

			return false;
		}

		if (args.end_date != "" && args.start_date == "" && dates.compare(args.end_date, item["pay_date"]) == -1) {
			return false;
		}

		if (args.start_date != "" && args.end_date != "" && dates.inRange(item["pay_date"], args.start_date, args.end_date) == false) {
			return false;
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
				"{url}index.php?option=com_maianmedia&controller=sales&format=raw&task=getdata",
				function(data) {
					// called whenever the server gets around to sending
					// back the data
					dataView.beginUpdate();
					dataView.setItems(data);
					dataView.setFilterArgs( {
						custName : custName,
						email : email,
						invoice : invoice,
						txn_id : txn_id,
						start_date : start_date,
						end_date : end_date,
						active_cart_search : active_cart_search
					});
					dataView.setFilter(myFilter);
					dataView.endUpdate();

				});

		grid = new Slick.Grid("#myGrid", dataView, columns, options);
		grid.setSelectionModel(new Slick.RowSelectionModel());

		dataView.setPagingOptions({
			   pageSize: 12
			});
		
		var pager = new Slick.Controls.Pager(dataView, grid, jQuery("#pager"));
		var columnpicker = new Slick.Controls.ColumnPicker(columns, grid,
				options);

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

			custName = this.value;
			updateFilter();
		});

		jQuery("#email").keyup(function(e) {
			Slick.GlobalEditorLock.cancelCurrentEdit();

			// clear on Esc
			if (e.which == 27) {
				this.value = "";
			}

			email = this.value;
			updateFilter();
		});

		jQuery("#invoice").keyup(function(e) {
			Slick.GlobalEditorLock.cancelCurrentEdit();

			// clear on Esc
			if (e.which == 27) {
				this.value = "";
			}

			invoice = this.value;
			updateFilter();
		});

		jQuery("#txn_id").keyup(function(e) {
			Slick.GlobalEditorLock.cancelCurrentEdit();

			// clear on Esc
			if (e.which == 27) {
				this.value = "";
			}

			txn_id = this.value;
			updateFilter();
		});

		jQuery("#start_date").bind("keyup input paste change", function(e) {
			Slick.GlobalEditorLock.cancelCurrentEdit();
			// clear on Esc
			if (e.which == 27) {
				this.value = "";
			}

			start_date = this.value;
			updateFilter();
		});

		jQuery("#end_date").keyup(function(e) {
			Slick.GlobalEditorLock.cancelCurrentEdit();

			// clear on Esc
			if (e.which == 27) {
				this.value = "";
			}

			end_date = this.value;
			updateFilter();
		});

		jQuery("#active_cart_search_yes").change(function(e) {
			Slick.GlobalEditorLock.cancelCurrentEdit();

			// clear on Esc
			if (e.which == 27) {
				this.value = "";
			}

			active_cart_search = this.value;
			updateFilter();
		});
		jQuery("#active_cart_search_no").change(function(e) {
			Slick.GlobalEditorLock.cancelCurrentEdit();

			// clear on Esc
			if (e.which == 27) {
				this.value = "";
			}

			active_cart_search = this.value;
			updateFilter();
		});

		function updateFilter() {
			dataView.setFilterArgs( {
				custName : custName,
				email : email,
				invoice : invoice,
				txn_id : txn_id,
				start_date : start_date,
				end_date : end_date,
				active_cart_search : active_cart_search
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

	window.addEvent('domready', function() {
		SqueezeBox.initialize( {});
		SqueezeBox.assign($$('a.modal-button'), {
			parse : 'rel'
		});

		Calendar.setup( {
			inputField : "start_date", // ID of the input field
			ifFormat : "%Y-%m-%d", // the date format
			button : "start_date_img", // ID of the button
			onUpdate : start_date_update
		});

		Calendar.setup( {
			inputField : "end_date", // ID of the input field
			ifFormat : "%Y-%m-%d", // the date format
			button : "end_date_img", // ID of the button
			onUpdate : end_date_update
		});

	});

	function removeSale(id, message, yes, no) {
		var answer = confirm(message, yes, no);
		if (answer) {
			dataView.deleteItem(id);
		}
	}

	function start_date_update() {
		start_date = jQuery("#start_date").val();
		
		dataView.setFilterArgs( {
			custName : custName,
			email : email,
			invoice : invoice,
			txn_id : txn_id,
			start_date : start_date,
			end_date : end_date,
			active_cart_search : active_cart_search
		});
		dataView.refresh();
	}

	function end_date_update() {
		end_date = jQuery("#end_date").val();
		dataView.setFilterArgs( {
			custName : custName,
			email : email,
			invoice : invoice,
			txn_id : txn_id,
			start_date : start_date,
			end_date : end_date,
			active_cart_search : active_cart_search
		});
		dataView.refresh();
		updateFilter();
	}
