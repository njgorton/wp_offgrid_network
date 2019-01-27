import $ from 'jquery';

class Search {
    // 1. Describe and create/intiate our object
    constructor() {
        this.addSearchHTML();
        this.resultsDiv = $("#search__results");
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search__close");
        this.searchOverlay = $(".search");
        this.searchField = $("#search-term");
        this.events();
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.typingTimer;
    }

    // 2. events
    events() {
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        $(document).on("keydown", this.keyPressDispatcher.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));
    }

    // 3. methods (function, action...)
    typingLogic() {
        if(this.searchField.val() != this.previousValue) {
            clearTimeout(this.typingTimer);

            if(this.searchField.val()) {
                if(!this.isSpinnerVisible) {
                    this.resultsDiv.html(`
                        <div class="loader">
                            <div class="square"></div>
                            <div class="square"></div>
                            <div class="square"></div>
                            <div class="square"></div>
                            <div class="square"></div>
                            <div class="square"></div>
                            <div class="square"></div>
                            <div class="square"></div>
                            <div class="square"></div>
                        </div>
                    `);
                    this.isSpinnerVisible = true;
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 750);
            } else {
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }
        }
        this.previousValue = this.searchField.val();
    }

    getResults() {
        $.getJSON(ogn_data.root_url + '/wp-json/offgrid/v1/search?term=' + this.searchField.val(), (results) => {
            this.resultsDiv.html(`
                ${!results.events.length && !results.news.length && !results.generalInfo.length ?
                    '<p class="search__noResults">Sorry, nothing matches your search.</p>' : `
                    <h2 class="search__heading">Search Results...</h2>
                    <div class="search__resultsDiv">
                    `}
                    
                    <!-- =====EVENT RESULTS===== -->
                    ${results.events.length ? '<h3 class="search__category-heading">Upcoming Events!</h3><ul class="search__list">' : ''}
                    ${results.events.map(item => `
                        <li class="search__listItem">
                            <a class="search__title" href="${item.permalink}"><i class="far fa-calendar-alt"></i>${item.title}</a>
                            <h4 class="search__subtitle">On ${item.month} ${item.day}, ${item.year}</h4>
                            <div class="search__content">
                                <image src="${item.image}" class="search__image">
                                <p class="search__description">${item.description}&nbsp;<a href="${item.permalink}" class="search__readMore">Learn more</a></p>
                            </div>
                        </li>
                    `).join('')}
                    ${results.events.length ? '</ul>' : ''}

                    <!-- =====NEWS RESULTS===== -->
                    ${results.news.length ? '<h3 class="search__category-heading">News</h3><ul class="search__list">' : ''}
                    ${results.news.map(item => `
                        <li class="search__listItem">
                            <a class="search__title" href="${item.permalink}"><i class="far fa-newspaper"></i>${item.title}</a>
                            <h4 class="search__subtitle">Posted by ${item.authorName}, on ${item.postedOn}</h4>
                            <div class="search__content">
                                <image src="${item.image}" class="search__image">
                                <p class="search__description">${item.description}&nbsp;<a href="${item.permalink}" class="search__readMore">Learn more</a></p>
                            </div>
                        </li>
                    `).join('')}
                    ${results.news.length ? '</ul>' : ''}
                        
                    <!-- =====GENERAL SEARCH RESULTS===== -->
                    ${results.generalInfo.length ? '<h3 class="search__category-heading">General Info</h3><ul class="search__list">' : ''}
                    ${results.generalInfo.map(item => `
                        <li class="search__listItem search__listItem--general">
                            <a class="search__title" href="${item.permalink}">${item.title}</a>
                        </li>
                    `).join('')}
                    ${results.generalInfo.length ? '</ul>' : ''}
                </div>
            `);
            this.isSpinnerVisible = false;
        });
    }

    keyPressDispatcher(e) { 
        if(e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
            this.openOverlay(); 
        }

        if(e.keyCode == 27 && this.isOverlayOpen) {
            this.closeOverlay(); 
        }
    }

    openOverlay() {
        this.searchOverlay.addClass("search--active");
        $("body").addClass("body-no-scroll");
        this.searchField.val('');
	    setTimeout(() => this.searchField.focus(), 301);
        this.isOverlayOpen = true;
    }

    closeOverlay() {
        this.searchOverlay.removeClass("search--active");
        $("body").removeClass("body-no-scroll");
        this.isOverlayOpen = false;
    }

    addSearchHTML() {
        $("body").append(`
            <div class="search">
                <div class="search__top">
                    <div class="search__inputArea">
                        <i class="fa fa-search search__icon" aria-hidden="true"></i>
                        <input type="text" class="search__search-term" id="search-term" placeholder="What are you looking for?">
                        <i class="fa fa-window-close search__close" aria-hidden="true"></i>
                    </div>
                </div>
            
                <div>
                    <div id="search__results"></div>
                </div>
            </div>
        `);
    }
}

export default Search;