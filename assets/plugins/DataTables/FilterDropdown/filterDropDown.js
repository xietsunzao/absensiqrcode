/*
 * filterDropDown.js
 *
 * Copyright (C) 2017-18 Erik Kalkoken
 * 
 * Extension for the jQuery plug-in DataTables (developed and tested with v1.10.15)
 *
 * HISTORY
 * 29-APR-2018 v0.3.0 Change: Added option to turn-off auto-sizing. useful if table is rendered on hidden tab
 * 27-NOV-2017 v0.2.1 Fix: Auto-Width of Select was too small with Chrome
 * 16-SEP-2017 v0.2.0 Change: removed cssStyle, cssClass parameter removed, replaced with generated classes for wrapper and selects
 *    renamed titleOverride to title, added label parameter to customized label text, 
 *    added automatic max-width based on title size, added optional maxWidth to override / turn-off the automatic
 * 29-AUG-2017 v0.1.0 Initial version
 *
**/

(function($){
	
	// parse initialization array and returns filterDef array to faster and easy use
	// also sets defaults for properties that are not set
	function parseInitArray(initArray)
	{
		// initialization and setting defaults
		var filterDef = {
			"columns": [],
			"columnsIdxList": [],
			"bootstrap": false,
			"autoSize": true,
			"label": "Filter "
		};
		
		// set filter properties if they have been defined, otherwise the defaults will be used
		if ( ("bootstrap" in initArray) && (typeof initArray.bootstrap === 'boolean') )
		{
			filterDef.bootstrap = initArray.bootstrap;
		}

		if ( ("autoSize" in initArray) && (typeof initArray.autoSize === 'boolean') )
		{
			filterDef.autoSize = initArray.autoSize;
		}

		if ( ("label" in initArray) && (typeof initArray.label === 'string') )
		{
			filterDef.label = initArray.label;
		}
									
		// add definition for each column
		if ("columns" in initArray)
		{								
			for(var i = 0; i < initArray.columns.length; i++)
			{
				var initColumn = initArray.columns[i];
				
				if ( ("idx" in initColumn) && (typeof initColumn.idx === 'number') )
				{
					// initialize column					
					var idx = initColumn.idx;					
					filterDef['columns'][idx] = {						
						"title": null,
						"maxWidth": null,
						"autoSize": true
					};
					
					// add to list of indeces in same order they appear in the init array
					filterDef['columnsIdxList'].push(idx);
					
					// set column properties if they have been defined, otherwise the defaults will be used
					if ( ('title' in initColumn) 
						&& (typeof initColumn.title === 'string') 
					){
						filterDef['columns'][idx].title = initColumn.title;
					}
					
					if ( ('maxWidth' in initColumn) 
						&& (typeof initColumn.maxWidth === 'string') 						
					){
						filterDef['columns'][idx].maxWidth = initColumn.maxWidth;
					}
					
					if ( ('autoSize' in initColumn) 
						&& (typeof initColumn.autoSize === 'boolean')
					){
						filterDef['columns'][idx].autoSize = initColumn.autoSize;
					}	
				}
			}			
		}
		
		return filterDef;		
	}
	
	// Add filterDropDown container div, draw select elements with default options
	// use preInit so that elements are created and correctly shown before data is loaded
	$(document).on( 'preInit.dt', function ( e, settings ) 
	{
		if ( e.namespace !== 'dt' ) {
			return;
		}
		
		// get api object for current dt table
		var api = new $.fn.dataTable.Api( settings );
		
		// get id of current table
		var id = api.table().node().id;
		
		// get initialisation object for current table to retrieve custom settings
		var initObj = api.init();
		
		// only proceed if filter has been defined in current table, otherwise don't do anything.
		if (!("filterDropDown" in initObj)) return;
				
		// get current filter definition from init array
		var filterDef =  parseInitArray(initObj.filterDropDown);
		
		// only proceed if there are any columns defined
		if (filterDef.columns.length == 0) return;		
		
		// get container div for current data table to add new elements to
		var container = api.table().container();
		
		// add filter elements to DOM			
		var filterWrapperId = id + "_filterWrapper";
		var divCssClass = filterWrapperId + " " + (
			(filterDef.bootstrap) 
				? "form-inline" 
				: ""
		);
		$(container).prepend(
			'<div id="' + filterWrapperId + '" class="' + divCssClass + '">' 
			+ filterDef.label + '</div>'
			);
		
		api.columns(filterDef.columnsIdxList).every( function () 
		{
			var column = this;
			var idx = column.index();
			
			// set title of current column
			var colName = ( filterDef.columns[idx].title !== null )
				? filterDef.columns[idx].title 
				: $(this.header()).html();
			
			if (colName == "") colName = 'column ' + (idx + 1);
						
			// adding select element for current column to container
			var selectClass = "form-control " + id + "_filterSelect";			
			var selectId = id + "_filterSelect" + idx;		
			$('#' + filterWrapperId).append('<select id="' + selectId 
				+ '" class="' + selectClass + '"></select>');
			
			// initalising select for current column and appling event to react to changes
			var select = $("#" + selectId).empty()
				.append( '<option value="">(' + colName + ')</option>' );
			
			// set max width of select elements to current width (which is defined by the size of the title)
			// turn off on for very small screens for responsive design or if autoSize has been set to false
			if ( filterDef.autoSize && filterDef.columns[idx].autoSize && (screen.width > 768) )
			{
				select.css('max-width', select.outerWidth());
			}
						
			// apply optional css tyle if defined in init array
			// will override automatic max width setting
			if (filterDef.columns[idx].maxWidth !== null)
			{
				select.css('max-width', filterDef.columns[idx].maxWidth);
			}	
		} );
	
	} );
	
	// filter table and add available options to dropDowns
	$(document).on( 'init.dt', function ( e, settings ) 
	{
		if ( e.namespace !== 'dt' ) {
			return;
		}
		
		// get api object for current dt table
		var api = new $.fn.dataTable.Api( settings );
		
		// get id of current table
		var id = api.table().node().id;
		
		// get initialisation object for current table to retrieve custom settings
		var initObj = api.init();
		
		// only proceed if filter has been defined in current table, otherwise don't do anything.
		if (!("filterDropDown" in initObj)) return;
		
		// get current filter definition
		var filterDef =  parseInitArray(initObj.filterDropDown);
		
		// get container div for current data table to to add new elements to
		var container = api.table().container();
						
		api.columns(filterDef.columnsIdxList).every( function () 
		{
			var column = this;
			var idx = column.index();
						
			// adding select element for current column to container
			var selectId = id + "_filterSelect" + idx;							
						
			// initalising select for current column and appling event to react to changes
			var select = $("#" + selectId);				
			
			select.on( 'change', function () 
			{
				var val = $.fn.dataTable.util.escapeRegex(
					$(this).val()
				);

				column
					.search( val ? '^' + val + '$' : '', true, false )
					.draw();
			} );

			column.data().unique().sort().each( function ( d, j ) 
			{
				if (d != "") select.append( '<option value="' + d + '">' + d + '</option>' );
			} );
		
		} );
	
	} );

}(jQuery));

