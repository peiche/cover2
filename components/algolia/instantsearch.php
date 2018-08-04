<?php
/**
 * The template for displaying Algolia Instant Search.
 *
 * @package Cover2
 */

get_header(); ?>

	<div id="ais-wrapper">
		<div class="cf">
			<header class="page-header">
				<div class="page-header__image"></div>
				<div class="page-header__content">
					<div id="algolia-search-box" class="page-title text-align-center">
						<div id="algolia-stats"></div>
					</div>
				</div>
				
			</header>
			
			<aside id="ais-facets">
				<section class="ais-facets" id="facet-post-types"></section>
				<section class="ais-facets" id="facet-categories"></section>
				<section class="ais-facets" id="facet-tags"></section>
				<section class="ais-facets" id="facet-users"></section>
			</aside>
			<main id="ais-main">
				<div id="algolia-hits"></div>
				<div id="algolia-pagination"></div>
			</main>
		</div>
		
	</div>

	<script type="text/html" id="tmpl-instantsearch-hit">
		<article class="hentry" itemtype="http://schema.org/Article">
			<div class="ais-hits--content">
				<header class="entry-header">
					<h2 class="entry-title" itemprop="name headline">
						<a href="{{ data.permalink }}" title="{{ data.post_title }}" itemprop="url">{{{ data._highlightResult.post_title.value }}}</a>
					</h2>
					<div class="entry-meta">
						<span class="byline">
							<span class="author vcard">
								<a class="url fn n" href="/?author={{{ data.post_author.user_id }}}">
									<!-- <img class="avatar avatar-35 photo avatar-author-{{ data.post_author.user_id }}" alt="Profile Picture for {{ data.post_author.display_name }}" src="" width="35" height="35"> -->
									<span class="author-text">{{{ data.post_author.display_name }}}</span>
								</a>
							</span>
						</span>
						—
						<span class="posted-on">
							<a href="{{ data.permalink }}" rel="bookmark">
								<time class="entry-date published updated">
									<#
										var locale = '<?php echo get_locale(); ?>'.replace('_', '-');
										var date = new Date(data.post_date * 1000);
										var options = {
											year: 'numeric',
											month: 'long',
											day: 'numeric'
										};
									#>
									{{ date.toLocaleDateString(locale, options) }}
								</time>
							</a>
						</span>
					</div>
				</header>
				<div class="entry-summary">
					<p>
			            <# if ( data._snippetResult['content'] ) { #>
			              <span class="suggestion-post-content">{{{ data._snippetResult['content'].value }}}</span>
			            <# } #>
					</p>
				</div>
			</div>
			<div class="ais-clearfix"></div>
		</article>
	</script>

	<script type="text/javascript">
		jQuery(function() {
			
			jQuery('body').addClass('algolia-search');
			
			jQuery('.filter-toggle').removeClass('hide');
			
			if (jQuery('#algolia-search-box').length > 0) {

				if (algolia.indices.searchable_posts === undefined && jQuery('.admin-bar').length > 0) {
					alert('It looks like you haven\'t indexed the searchable posts index. Please head to the Indexing page of the Algolia Search plugin and index it.');
				}

				/* Instantiate instantsearch.js */
				var search = instantsearch({
					appId: algolia.application_id,
					apiKey: algolia.search_api_key,
					indexName: algolia.indices.searchable_posts.name,
					urlSync: {
						mapping: {'q': 's'},
						trackedParameters: ['query']
					},
					searchParameters: {
						facetingAfterDistinct: true,
			            highlightPreTag: '__ais-highlight__',
			            highlightPostTag: '__/ais-highlight__'
					},
					routing: true
					/*
					routing: {
						stateMapping: {
							stateToRoute(uiState) {
								return {
									query: uiState.query,
									tag: uiState.refinementList && uiState.refinementList.taxonomies.post_tag.join('~'),
									page: uiState.page
								};
							},
							routeToState(routeState) {
								return {
									query: routeState.query,
									refinementList: {
										tag: routeState.taxonomies.post_tag && routeState.taxonomies.post_tag.split('~')
									},
									page: routeState.page
								};
							}
						}
					}
					*/
				});

				/* Search box widget */
				search.addWidget(
					instantsearch.widgets.searchBox({
						container: '#algolia-search-box',
						placeholder: 'Search for...',
						wrapInput: false,
						poweredBy: algolia.powered_by_enabled
					})
				);

				/* Stats widget */
				search.addWidget(
					instantsearch.widgets.stats({
						container: '#algolia-stats'
					})
				);

				/* Hits widget */
				search.addWidget(
					instantsearch.widgets.hits({
						container: '#algolia-hits',
						hitsPerPage: 10,
						templates: {
							empty: 'No results were found for "<strong>{{query}}</strong>".',
							item: wp.template('instantsearch-hit')
						},
						transformData: {
									  item: function (hit) {
							for(var key in hit._highlightResult) {
							  // We do not deal with arrays.
							  if(typeof hit._highlightResult[key].value !== 'string') {
								continue;
							  }
							  hit._highlightResult[key].value = _.escape(hit._highlightResult[key].value);
							  hit._highlightResult[key].value = hit._highlightResult[key].value.replace(/__ais-highlight__/g, '<em>').replace(/__\/ais-highlight__/g, '</em>');
							}

							for(var key in hit._snippetResult) {
							  // We do not deal with arrays.
							  if(typeof hit._snippetResult[key].value !== 'string') {
								continue;
							  }

							  hit._snippetResult[key].value = _.escape(hit._snippetResult[key].value);
							  hit._snippetResult[key].value = hit._snippetResult[key].value.replace(/__ais-highlight__/g, '<em>').replace(/__\/ais-highlight__/g, '</em>');
							}

							return hit;
						  }
						}
					})
				);

				/* Pagination widget */
				search.addWidget(
					instantsearch.widgets.pagination({
						container: '#algolia-pagination'
					})
				);

				/* Categories refinement widget */
				// https://community.algolia.com/instantsearch.js/v2/widgets/hierarchicalMenu.html
				search.addWidget(
					instantsearch.widgets.hierarchicalMenu({
						container: '#facet-categories',
						separator: ' > ',
						sortBy: ['count'],
						attributes: ['taxonomies_hierarchical.category.lvl0', 'taxonomies_hierarchical.category.lvl1', 'taxonomies_hierarchical.category.lvl2'],
						templates: {
							header: '<h3 class="widgettitle">Categories</h3>'
						}
					})
				);

				/* Tags refinement widget */
				search.addWidget(
					instantsearch.widgets.refinementList({
						container: '#facet-tags',
						attributeName: 'taxonomies.post_tag',
						operator: 'and',
						limit: 15,
						showMore: true,
						sortBy: ['isRefined:desc', 'count:desc', 'name:asc'],
						templates: {
							header: '<h3 class="widgettitle">Tags</h3>',
							item: '<input type="checkbox" class="{{cssClasses.checkbox}}" value="{{name}}" {{#isRefined}}checked{{/isRefined}} /><label class="{{cssClasses.label}}">{{{highlighted}}} <span class="{{cssClasses.count}}">{{#helpers.formatNumber}}{{count}}{{/helpers.formatNumber}}</span>\n</label>'
						}
					})
				);

				/* Users refinement widget */
				search.addWidget(
					instantsearch.widgets.menu({
						container: '#facet-users',
						attributeName: 'post_author.display_name',
						sortBy: ['name:asc'],
						limit: 10,
						templates: {
							header: '<h3 class="widgettitle">Authors</h3>'
						}
					})
				);
				
				/* Start */
				search.start();

				jQuery('#algolia-search-box input').attr('type', 'search').select();
				
				jQuery('.site-footer').css('display', 'block');
			}
		});
	</script>

<?php get_footer(); ?>
