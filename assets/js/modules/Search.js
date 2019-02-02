import $ from 'jquery';

class Search {
    // 1. Describe and create/intiate our object
    constructor() {
        this.addSearchHTML();
        this.resultsDiv = $("#search-overlay__results");
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
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
                    '<p class="search-overlay__noResults">Sorry, nothing matches your search.</p>' : `
                    <h2 class="search-overlay__heading">Search Results...</h2>
                    <div class="search-overlay__resultsDiv">
                    `}
                    
                    <!-- =====EVENT RESULTS===== -->
                    ${results.events.length ? '<h3 class="search-overlay__category-heading">Upcoming Events!</h3><ul class="search-overlay__list">' : ''}
                    ${results.events.map(item => `
                        <li class="search-overlay__listItem">
                            <a class="search-overlay__title" href="${item.permalink}"><i class="far fa-calendar-alt"></i>${item.title}</a>
                            <h4 class="search-overlay__subtitle">On ${item.month} ${item.day}, ${item.year}</h4>
                            <div class="search-overlay__content">
                                <image src="${item.image}" class="search-overlay__image">
                                <p class="search-overlay__description">${item.description}&nbsp;<a href="${item.permalink}" class="search-overlay__readMore">Learn more</a></p>
                            </div>
                        </li>
                    `).join('')}
                    ${results.events.length ? '</ul>' : ''}

                    <!-- =====NEWS RESULTS===== -->
                    ${results.news.length ? '<h3 class="search-overlay__category-heading"> Related News</h3><ul class="search-overlay__list">' : ''}
                    ${results.news.map(item => `
                        <li class="search-overlay__listItem">
                            <a class="search-overlay__title" href="${item.permalink}"><i class="far fa-newspaper"></i>${item.title}</a>
                            <h4 class="search-overlay__subtitle">Posted by ${item.authorName}, on ${item.postedOn}</h4>
                            <div class="search-overlay__content">
                                <image src="${item.image}" class="search-overlay__image">
                                <p class="search-overlay__description">${item.description}&nbsp;<a href="${item.permalink}" class="search-overlay__readMore">Learn more</a></p>
                            </div>
                        </li>
                    `).join('')}
                    ${results.news.length ? '</ul>' : ''}
                        
                    <!-- =====GENERAL SEARCH RESULTS===== -->
                    ${results.generalInfo.length ? '<h3 class="search-overlay__category-heading">General Info</h3><ul class="search-overlay__list">' : ''}
                    ${results.generalInfo.map(item => `
                        <li class="search-overlay__listItem search-overlay__listItem--general">
                            <a class="search-overlay__title" href="${item.permalink}">${item.title}</a>
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
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        this.searchField.val('');
	    setTimeout(() => this.searchField.focus(), 301);
        this.isOverlayOpen = true;
        return false;
    }

    closeOverlay() {
        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        this.isOverlayOpen = false;
    }

    addSearchHTML() {
        $("body").append(`
            <div class="search-overlay">
                <div class="search-overlay__top">
                    <div class="search-overlay__inputArea">
                        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                        <input type="text" class="search-overlay__search-term" id="search-term" placeholder="What are you looking for?">
                        <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
                    </div>
                </div>
            
                <div>
                    <div id="search-overlay__results"></div>
                </div>
            </div>
        `);
    }
}

export default Search;