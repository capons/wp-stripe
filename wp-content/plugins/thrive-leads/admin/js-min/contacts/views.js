/*! Thrive Leads - The ultimate Lead Capture solution for wordpress - 2016-12-07
* https://thrivethemes.com 
* Copyright (c) 2016 * Thrive Themes */
var ThriveLeads=ThriveLeads||{};ThriveLeads.views=ThriveLeads.views||{},jQuery(function(){ThriveLeads.views.Contacts=Backbone.View.extend({events:{"click .tve-leads-clear-cache":"clearCacheStats","click .tl-inbound-link-builder":"inboundLinkBuilder"},viewItems:[],render:function(){return this.$el.find(".tve-setting-change").on("change",_.bind(this.globalSetting,this)),this},inboundLinkBuilder:function(){TVE_Dash.modal(ThriveLeads.views.lightbox.InboundLink,{title:ThriveLeads["const"].translations.InboundLinkBuilder,"max-width":"80%",width:750,collection:ThriveLeads.objects.groups,model:new ThriveLeads.models.InboundLink})},toggleGlobalSettings:function(a){return jQuery(a.currentTarget).parents(".tve-global-settings").toggleClass("tve-expanded"),!1},globalSetting:function(a){var b=jQuery(a.currentTarget),c={action:"thrive_leads_backend_ajax",route:"globalSettingsAPI",field:b.attr("name"),value:b.attr("value")};b.is('input[type="checkbox"]')&&!b.is(":checked")&&(c.value=0),this.globalSettings[c.field]=c.value,jQuery.post(ajaxurl,c)},clearCacheStats:function(){TVE_Dash.showLoader(),jQuery.post(ajaxurl,{action:"thrive_leads_backend_ajax",route:"clearCacheStatistics"},function(){location.reload()})}})});