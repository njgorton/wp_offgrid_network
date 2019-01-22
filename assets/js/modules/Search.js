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
                    this.resultsDiv.html(
                        '<div class="loader">\
                            <div class="square"></div>\
                            <div class="square"></div>\
                            <div class="square"></div>\
                            <div class="square"></div>\
                            <div class="square"></div>\
                            <div class="square"></div>\
                            <div class="square"></div>\
                            <div class="square"></div>\
                            <div class="square"></div>\
                        </div>'
                    );
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
                <ul class="search-overlay__link-list">
                    <!-- =====EVENT RESULTS===== -->
                    ${results.events.length ? '<li><h3>Upcoming Events!</h3><br>' : ''}
                    ${results.events.map(item => `
                        <a href="${item.permalink}">${item.title}</a>
                        <span>${item.month}</span>
                        <span>${item.day}</span>
                        <p>${item.description}<a href="${item.permalink}">Learn more</a></p>
                    `).join('')}
                    ${results.events.length ? '</li>' : ''}

                    <!-- =====NEWS RESULTS===== -->
                    ${results.news.length ? '<li><h3>News</h3><br>' : ''}
                    ${results.news.map(item => `
                        <a href="${item.permalink}">${item.title}</a>
                        ${item.postType == 'news' ? `posted by, ${item.authorName}` : ''}
                        <p>${item.description}<a href="${item.permalink}">Learn more</a></p>
                    `).join('')}
                    ${results.news.length ? '</li>' : ''}
                        
                    <!-- =====GENERAL SEARCH RESULTS===== -->
                    ${results.generalInfo.length ? '<li><h3>General Info</h3><br>' : ''}
                    ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                    ${results.generalInfo.length ? '</li>' : ''}
                </ul>
            `);
            this.isSpinnerVisible = false;
        });

        // DELETE THIS CODE LATER ON...
        // $.when(
        //     $.getJSON(ogn_data.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()),
        //     $.getJSON(ogn_data.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val()),
        //     $.getJSON(ogn_data.root_url + '/wp-json/wp/v2/news?search=' + this.searchField.val()),
        //     $.getJSON(ogn_data.root_url + '/wp-json/wp/v2/events?search=' + this.searchField.val())
        //     ).then((posts, pages, news, events) => {
        //     var combinedResults = posts[0].concat(pages[0], news[0], events[0]);
        //     this.resultsDiv.html(`
        //         <h2 class="search-overlay__title">Search Results...</h2>
        //         ${combinedResults.length ? '<ul class="search-overlay__link-list">' : '<p class="search-overlay__noResults">Sorry, nothing matches your search.</p>'}
        //         ${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a><br> ${item.type == 'news' ? `<p>by ${item.authorName}</p>` : ''}</li>`).join('')}
        //         ${combinedResults.length ? '</ul>' : ''}
        //     `);
        //     this.isSpinnerVisible = false;
        // }, () => {
        //     this.resultsDiv.html('<p class="search-overlay__noResults">Whoops... something went wrong; please try again.</p>');
        // });
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