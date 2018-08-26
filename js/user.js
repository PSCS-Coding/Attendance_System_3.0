Vue.component('page-title', {
    template: `
    <div v-if='$root.statusData' id='title'>
        <h1>{{$root.firstName}} {{[...$root.lastName][0]}}.</h1>
        <h3>Status: {{$root.statusData[$root.statusId].statusName.toLowerCase()}}</h3>
    </div>`
});

Vue.component('status-change', {
    props: {
        statusName: String,
        hasInfo: Boolean,
        hasReturnTime: Boolean,
        statusId: Number
    },
    template: `
    <div class='status-change'>
        <input v-if='hasReturnTime' placeholder='Return Time' class='return-time timepicker'>
        <input v-if='hasInfo' :placeholder='infoText' :class='infoClasses'>
        <input type='submit' @click='statusChange' :value='statusName'>
        <!-- Form, method for changing status-->
    </div>`,
    methods: {
        statusChange: function () {
            alert(this.statusId);
            return 0;
        }
    },
    computed: {
        infoText: function () {
            return this.statusId == 3 ? 'Location' : 'Facilitator';
        },
        infoClasses: function () {
            return 'info ' + this.statusName.toLowerCase();
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
        statusId: '',
        statusData: false,
        studentId: getUrlParameter('student') ? getUrlParameter('student') : null,
        locations: [],
        facilitators: [],
        globals: []
    },
    methods: {
        load: function () {
            let self = this;
            //will be replaced when I integrate login:
            if (!this.studentId) {
                this.studentId = '1';
            }
            axios.get('./backend/request.php?f=user&id=' + this.$root.studentId)
                .then(function (response) {
                    self.firstName = decodeAndParse(response.data.split('/')[0] + '').first_name;
                    self.lastName = decodeAndParse(response.data.split('/')[0] + '').last_name;
                    self.statusId = decodeAndParse(response.data.split('/')[0] + '').status_id;

                    let statusList = [];
                    decodeAndParse(response.data.split('/')[1] + '').forEach(status => {
                        statusList.push({
                            statusName: status.status_name,
                            hasReturnTime: (status.has_return_time == 1 ? true : false),
                            hasInfo: (status.has_info == 1 ? true : false)
                        });
                    });

                    self.statusData = statusList;

                    self.locations = Object.values(decodeAndParse(response.data.split('/')[2] + ''));
                    self.facilitators = Object.values(decodeAndParse(response.data.split('/')[3] + ''));
                    globalsArray = Object.values(decodeAndParse(response.data.split('/')[4] + ''));
                    self.globals = {
                        startTime: moment(globalsArray[0], 'HH:mm:ss'),
                        endTime: moment(globalsArray[1], 'HH:mm:ss')
                    }

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
            let q = './backend/request.php?f=changestatus&status=' + status + '&students=' + self.studentId;
            let usingReturn = false;
            if (returnTime) {
                usingReturn = true;
                q += '&returntime=' + returnTime;
            }
            if (info) q += '&info=' + info;

            if (!usingReturn || moment(returnTime, 'h:mma', true).isValid()) {
                axios.get(q)
                    .then(function (response) {
                        self.load();
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