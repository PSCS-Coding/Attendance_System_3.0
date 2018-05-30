Vue.component('page-title', {
    template: `
    <div id='title'>
        <h1>{{$root.firstName}} {{[...$root.lastName][0]}}.</h1>
        <h3>is {{$root.statusName.toLowerCase()}}</h3>
    </div>`,
    methods: {
        close: function () {
            $('#error-container').css('display', 'none');
        }
    }
});

Vue.component('error-message', {
    template: `
    <div id='error-container' style='display: none'>
        <span id='error-message'></span>
        <button @click='close'><i data-feather='x'></i></button>
    </div>`,
    methods: {
        close: function () {
            $('#error-container').css('display', 'none');
        }
    }
});

Vue.component('tabs', {
    template: `
        <div>
            <div class="tabs">
                <ul>
                    <li v-for="tab in tabs" :class="{ 'is-active': tab.isActive }">
                        <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
                    </li>
                </ul>
            </div>
            <div class="tabs-details">
                <slot></slot>
            </div>
        </div>
    `,

    data() {
        return {
            tabs: []
        };
    },

    created() {
        this.tabs = this.$children;
    },

    methods: {
        selectTab(selectedTab) {
            this.tabs.forEach(tab => {
                tab.isActive = (tab.href == selectedTab.href);
            });
        }
    }
});


Vue.component('tab', {
    template: `
        <div class='tab' v-show="isActive"><slot></slot></div>
    `,

    props: {
        name: {
            required: true
        },
        selected: {
            default: false
        }
    },

    data() {
        return {
            isActive: false
        };
    },

    computed: {
        href() {
            return '#' + this.name.toLowerCase().replace(/ /g, '-');
        },
        isSelected: function () {
            return window.location.hash != '' ? (window.location.hash.substring(1) == this.name.toLowerCase().replace(/ /g, '-') ? true : false) : this.selected;
        }
    },

    mounted() {
        this.isActive = this.isSelected;
    },
});


var vm = new Vue({
    el: '#user-page',
    data: {
        firstName: '',
        lastName: '',
        statusName: ''
    },
    computed: {
        studentId: function () {
            return getUrlParameter('student');
        }
    },
    methods: {
        load: function () {
            let self = this;
            axios.get('./backend/request.php?f=user&id=' + this.$root.studentId)
                .then(function (response) {
                    self.firstName = response.data.first_name;
                    self.lastName = response.data.last_name;
                    self.statusName = response.data.status_name;

                    var font = new FontFaceObserver('Nunito');
                    font.load().then(function () {
                        $('#loading').fadeOut();
                        $("#content").fadeIn();
                    }, function () {
                        $('html').get(0).style.setProperty("--defFont", 'sans-serif');
                        $('#loading').fadeOut();
                        $("#content").fadeIn();
                    });
                })
                .catch(function (error) {
                    console.error('Request failed: [' + error + ']');
                    self.errorMessage('Fetching data failed. Try reloading the page.');
                });
        },
        errorMessage: function (message) {
            $('#error-container #error-message').text(message);
            $('#error-container').css('display', 'inline');
        },
        changeStatus: function (status, returnTime, info) {
            self = this;
            let q = './backend/request.php?f=changestatus&status=' + status + '&students=' + selected.join();
            let usingReturn = false;
            if (returnTime) {
                usingReturn = true;
                q += '&returntime=' + returnTime;
            }
            if (info) q += '&info=' + info;

            if (!usingReturn || moment(returnTime, 'h:mma', true).isValid()) {
                axios.get(q)
                    .then(function (response) {

                    })
                    .catch(function (error) {
                        self.errorMessage('Could not perform the action. Try again, or speak to a developer.');
                    });
            } else {
                this.errorMessage('You must enter a valid return time!');
                $('.timepicker').val('');
            }
        }
    },
    beforeMount() {
        this.load();
    },
    mounted() {
        feather.replace();
    }
});