jQuery(document).ready(function() {
	jQuery('#bdShortCode').val('[rpu]');

	var rpuContentOrig = jQuery('#rpuSampleContent').clone();

	jQuery('.rpushowTitle').click(function() {
		var TitleValue = jQuery('.rpushowTitle:checked').val();
		if(TitleValue == 0){
			if(!jQuery('#rpuSampleTitle').hasClass('bdHide')) {
				jQuery('#rpuSampleTitle').toggleClass('bdHide');
			}
			jQuery('#rputextTitle').val(' showtitle="no"');
		} else {
			if(jQuery('#rpuSampleTitle').hasClass('bdHide')) {
				jQuery('#rpuSampleTitle').toggleClass('bdHide');
			}
			jQuery('#rputextTitle').val('');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery('.rpushowDate').click(function() {
		var DateValue = jQuery('.rpushowDate:checked').val();
		if(DateValue == 0){
			if(!jQuery('#rpuSampleDate').hasClass('bdHide')) {
				jQuery('#rpuSampleDate').toggleClass('bdHide');
			}
			jQuery('#rputextDate').val(' showdate="no"');
		} else {
			if(jQuery('#rpuSampleDate').hasClass('bdHide')) {
				jQuery('#rpuSampleDate').toggleClass('bdHide');
			}
			jQuery('#rputextDate').val('');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery('.rpushowCategory').click(function() {
		var CategoryValue = jQuery('.rpushowCategory:checked').val();
		if(CategoryValue == 0){
			if(!jQuery('#rpuSampleCategory').hasClass('bdHide')) {
				jQuery('#rpuSampleCategory').toggleClass('bdHide');
			}
			jQuery('#rputextCategory').val(' showcategory="no"');
		} else {
			if(jQuery('#rpuSampleCategory').hasClass('bdHide')) {
				jQuery('#rpuSampleCategory').toggleClass('bdHide');
			}
			jQuery('#rputextCategory').val('');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery('.rpushowContent').click(function() {
		var ContentValue = jQuery('.rpushowContent:checked').val();
		if(ContentValue == 0){
			if(!jQuery('#rpuSampleContent').hasClass('bdHide')) {
				jQuery('#rpuSampleContent').toggleClass('bdHide');
			}
			jQuery('#rputextContent').val(' showcontent="no"');
		} else {
			if(jQuery('#rpuSampleContent').hasClass('bdHide')) {
				jQuery('#rpuSampleContent').toggleClass('bdHide');
			}
			jQuery('#rputextContent').val('');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery('.rpushowHTML').click(function() {
		var HTMLValue = jQuery('.rpushowHTML:checked').val();
		if(HTMLValue == 0){
			stringClean = jQuery('#rpuSampleContent').text();
			jQuery('#rpuSampleContent').html(stringClean);
			jQuery('#rputextHTML').val(' showhtml="no"');
		} else {
			jQuery('#rpuSampleContent').html(rpuContentOrig);
			jQuery('#rputextHTML').val('');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery('.rpuPostType').click(function() {
		var array = [];
		jQuery(".rpuPostType:checked").each(function() { 
			array.push(jQuery(this).val());
		});
		jQuery('#rputextCats').val('');
		jQuery(".rpuCategories").prop("checked", false);
		jQuery('#rputextPType').val(' ptype="' + array.sort() + '"');
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery('.rpuCategories').click(function() {
		var array = [];
		jQuery(".rpuCategories:checked").each(function() { 
			array.push(jQuery(this).val());
		});
		jQuery('#rputextPType').val('');
		jQuery('#rpupostType').prop('checked',true);
		jQuery('#rputextCats').val(' cats="' + array.sort() + '"');
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery("#rpuwordCNT").on('input', function(){
		var thewordCNT = jQuery("#rpuwordCNT").val();
		if(thewordCNT > 50){
			jQuery('#rputextWords').val(' words="' + thewordCNT + '"');
		} else if(thewordCNT < 50) {
			jQuery('#rputextWords').val(' words="' + thewordCNT + '"');
		} else {
			jQuery('#rputextWords').val('');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery("#rpupppgCNT").on('input', function(){
		var thepppgCNT = jQuery("#rpupppgCNT").val();
		if(thepppgCNT > 1){
			jQuery('#rputextpppg').val(' pppg="' + thepppgCNT + '"');
		} else {
			jQuery('#rputextpppg').val('');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery('.rpulinkTitle').click(function() {
		var linkTitleValue = jQuery('.rpulinkTitle:checked').val();
		if(linkTitleValue == 0){
			jQuery('#rputheLinkTitle').val('');
		} else {
			jQuery('#rputheLinkTitle').val(' linktitle="yes"');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});


	jQuery('.rpulinkContent').click(function() {
		var linkContentValue = jQuery('.rpulinkContent:checked').val();
		if(linkContentValue == 0){
			jQuery('#rputheLinkContent').val('');
		} else {
			jQuery('#rputheLinkContent').val(' linkcontent="yes"');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery('.rpulinkOther').click(function() {
		var linkOtherValue = jQuery('.rpulinkOther:checked').val();
		if(linkOtherValue == 0){
			jQuery('#rputheLinkOther').val('');
			jQuery('#rputheLinkWording').val('');
			jQuery('.rpulinkWording').val('Read more...');
		} else {
			jQuery('#rputheLinkOther').val(' linkother="yes"');
			jQuery('#rputheLinkWording').val(' linkwording="' + jQuery('.rpulinkWording').val() + '"');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery(".rpulinkWording").on('input', function(){
		var theWording = jQuery(".rpulinkWording").val();
		if(theWording != "Read more..."){
			if(!jQuery('#rpulinkOtherTrue').is(':checked')) {
				jQuery('#rpulinkOtherTrue').prop("checked", true);
			}
			jQuery('#rputheLinkOther').val(' linkother="yes"');
			jQuery('#rputheLinkWording').val(' linkwording="' + jQuery('.rpulinkWording').val() + '"');
		} else {
			jQuery('.rpuLinkWording').val('Read more...');
			jQuery('#rputheLinkWording').val('');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery('.rpuLinkTo').click(function() {
		var linkToValue = jQuery('.rpuLinkTo:checked').val();
//
//	Resetting values...
//
		if(linkToValue == "page"){
			if(jQuery('#rpuPageSelector').hasClass('bdHide')) {
				jQuery('#rpuPageSelector').toggleClass('bdHide');
			}
			if(!jQuery('#rpuURLSelector').hasClass('bdHide')) {
				jQuery('#rpuURLSelector').toggleClass('bdHide');
			}
			jQuery('#rpuLinkType').val(' linktype="' + linkToValue + '"');
		} else if(linkToValue == "other"){
			if(!jQuery('#rpuPageSelector').hasClass('bdHide')) {
				jQuery('#rpuPageSelector').toggleClass('bdHide');
			}
			if(jQuery('#rpuURLSelector').hasClass('bdHide')) {
				jQuery('#rpuURLSelector').toggleClass('bdHide');
			}
			jQuery('#rpuLinkType').val(' linktype="' + linkToValue + '"');
		} else {
			if(!jQuery('#rpuPageSelector').hasClass('bdHide')) {
				jQuery('#rpuPageSelector').toggleClass('bdHide');
			}
			if(!jQuery('#rpuURLSelector').hasClass('bdHide')) {
				jQuery('#rpuURLSelector').toggleClass('bdHide');
			}
			jQuery('#rpuLinkType').val('');
			jQuery('#rpuLinkToURL').val('');
			jQuery('#rpuLinkToFinal').val('');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery("#rpuSelectPage").on('input', function(){
		if(jQuery('#rpuSelectPage').val() != "") {
			jQuery('#rpuLinkToURL').val(jQuery('#rpuSelectPage').val());
			jQuery('#rpuLinkToFinal').val(' linktourl="' + jQuery('#rpuLinkToURL').val() + '"');
		} else {
			jQuery('#rpuLinkToURL').val('');
			jQuery('#rpuLinkToFinal').val('');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery("#rpuLinkToURL").on('input', function(){
		if(jQuery('#rpuLinkToURL').val() != "") {
			jQuery('#rpuLinkToFinal').val(' linktourl="' + jQuery('#rpuLinkToURL').val() + '"');
		} else {
			jQuery('#rpuLinkToFinal').val('');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery('.rpushowSticky').click(function() {
		var StickyValue = jQuery('.rpushowSticky:checked').val();
		if(StickyValue == 0){
			jQuery('#rputextSticky').val('');
		} else {
			jQuery('#rputextSticky').val(' showsticky="yes"');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery('.rpushowSortBy').click(function() {
		var SortByValue = jQuery('.rpushowSortBy option:selected').val();
		if(SortByValue == "date"){
			jQuery('#rputextSortBy').val('');
		} else {
			jQuery('#rputextSortBy').val(' sortby="' + SortByValue + '"');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});

	jQuery('.rpushowSortOrder').click(function() {
		var SortOrderValue = jQuery('.rpushowSortOrder:checked').val();
		if(SortOrderValue == "desc"){
			jQuery('#rputextSortOrder').val('');
		} else {
			jQuery('#rputextSortOrder').val(' sortorder="asc"');
		}
		jQuery('#bdShortCode').val('[rpu' + jQuery('#rputextTitle').val() + jQuery('#rputextDate').val() + jQuery('#rputextCategory').val() + jQuery('#rputextContent').val() + jQuery('#rputextHTML').val() + jQuery('#rputextWords').val() + jQuery('#rputextpppg').val() + jQuery('#rputextCats').val() + jQuery('#rputextPType').val() + jQuery('#rputheLinkTitle').val() + jQuery('#rputheLinkContent').val() + jQuery('#rputheLinkOther').val() + jQuery('#rputheLinkWording').val() + jQuery('#rpuLinkType').val() + jQuery('#rpuLinkToFinal').val() + jQuery('#rputextSticky').val() + jQuery('#rputextSortBy').val() + jQuery('#rputextSortOrder').val() + ']');
	});
});