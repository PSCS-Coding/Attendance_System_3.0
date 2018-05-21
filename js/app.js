Vue.component('student', {
    props: {
        studentId: Number,
        firstName: String,
        lastName: String,
        returnTime: String,
        info: String,
        status: String
    },
    template: `
        <div class='student'>
            <input type='checkbox' :value='studentId' :id='studentId' v-model='$root.selected'>
            <label :for='studentId'>
                {{ firstName }} {{ [...lastName][0] }}. | {{ $root.statusData[status] }}
                <span v-if='info'> | {{ info }} | {{ returnTime }}</span>
            </label>
        </div>`
});

Vue.component('student-list', {
    template: `
        <div class='student-list'>
            <student v-for='student of $root.students' :key='student.studentId' :student-id='student.studentId' :first-name='student.firstName' :last-name='student.lastName' :status='student.status' :return-time='student.returnTime' :info='student.info'></student>
        </div>`
});

Vue.component('offsite-modal', {
    template: `
        <div id="offsite-modal" class="modal">
            <div class="modal-content">
                <i class='close' data-feather="x"></i>
               <input type='text' id='offsite-location' placeholder='Location (future - jquery autocomplete)'>
               <input type='text' class='timepicker' id='offsite-return-time' placeholder='Return time'>
               <input type='submit' value='Offsite' @click='offsite()'>
            </div>
        </div>`,
    methods: {
        offsite: function () {
            const location = $('#offsite-modal #offsite-location').val();
            const returnTime = $('#offsite-modal #offsite-return-time').val();
            if (location.length > 0 && returnTime.length > 0) {
                this.$root.changeStatus('2', returnTime, location);
            } else {
                this.$root.errorMessage('You must provide a location and return time');
            }
        }
    }
});

Vue.component('field-trip-modal', {
    template: `
        <div id="field-trip-modal" class="modal">
            <div class="modal-content">
                <i class='close' data-feather="x"></i>
               <input type='text' id='field-trip-facilitator' placeholder='Facilitator (future - dropdown)'>
               <input type='text' class='timepicker' id='field-trip-return-time' placeholder='Return time'>
               <input type='submit' value='Field trip' @click='fieldTrip()'>
            </div>
        </div>`,
    methods: {
        fieldTrip: function () {
            const facilitator = $('#field-trip-modal #field-trip-facilitator').val();
            const returnTime = $('#field-trip-modal #field-trip-return-time').val();
            if (facilitator.length > 0 && returnTime.length > 0) {
                this.$root.changeStatus('3', returnTime, facilitator);
            } else {
                this.$root.errorMessage('You must provide a facilitator and return time');
            }
        }
    }
});

Vue.component('late-modal', {
    template: `
        <div id="late-modal" class="modal">
            <div class="modal-content">
                <i class='close' data-feather="x"></i>
               <input type='text' class='timepicker' id='late-return-time' placeholder='Return time'>
               <input type='submit' value='Late' @click='late()'>
            </div>
        </div>`,
    methods: {
        late: function () {
            const returnTime = $('#late-modal #late-return-time').val();
            if (returnTime.length > 0) {
                this.$root.changeStatus('5', returnTime);
            } else {
                this.$root.errorMessage('You must provide a return time');
            }
        }
    }
});

Vue.component('main-navbar', {
    template: `
        <nav class='main-navbar'>
            <ul>
            <li><a href='view_reports.php'>test</a></li>
                <span v-show='$root.selected.length > 0'>
                    <li><button @click='present()'>Present</button></li>
                    <li><button @click='modal("#offsite-modal")'>Offsite</button></li>
                    <li><button @click='modal("#late-modal")'>Late</button></li>
                    <li><button @click='modal("#field-trip-modal")'>Field trip</button></li>
                </span>
            </ul>
        </nav>`,
    methods: {
        modal: function (modalId) {
            if ($(modalId).length > 0) {

                $(modalId).css('display', 'block');

                $(modalId + ' .close').click(function () {
                    $(modalId).css('display', 'none');
                    $('.modal input[type="text"]').val('');
                });

                $(window).click(function (event) {
                    if ($(modalId).is(event.target)) {
                        $(modalId).css('display', 'none');
                        $('.modal input[type="text"]').val('');
                    }
                });
            } else {
                console.error('A valid id must be provided as the first parameter of modal()');
            }
        },
        present: function () {
            this.$root.changeStatus('1');
        }
    }
});

var vm = new Vue({
    el: '#attendance',
    data: {
        students: [],
        statusData: [],
        groups: [],
        locations: [],
        facilitators: [],
        globals: [],
        selected: []
    },
    methods: {
        load: function () {
            let self = this;
            axios.get('./backend/request.php?f=current')
                .then(function (response) {
                    const decodedStatus = decodeURIComponent((response.data.split('/')[0] + '').replace(/\+/g, '%20'));
                    const decodedCurrent = decodeURIComponent((response.data.split('/')[1] + '').replace(/\+/g, '%20'));
                    let studentList = [];
                    //statuses
                    self.$root.statusData = JSON.parse(decodedStatus);
                    //students array
                    JSON.parse(decodedCurrent).forEach(student => {
                        studentList.push(_.pickBy({
                            firstName: student.first_name,
                            lastName: student.last_name,
                            studentId: parseInt(student.student_id),
                            status: student.status_id,
                            returnTime: student.return_time,
                            info: student.info
                        }));
                    });
                    studentList.sort(function (a, b) {
                        return (a.firstName > b.firstName) ? 1 : ((b.firstName > a.firstName) ? -1 : 0);
                    });
                    self.$root.students = studentList;
                    self.$root.locations = ['Uwaji'];
                    self.$root.globals = ['9am', '3:40pm'];
                    self.$root.facilitators = [{
                        id: 1,
                        name: 'Nic'
                    }, {
                        id: 2,
                        name: 'Liana'
                    }];
                    self.$root.groups = [{
                        name: 'Climbing',
                        students: [1, 2, 3]
                    }, {
                        name: 'Volleyball',
                        students: [1, 3, 4]
                    }];

                    $('.timepicker').timepicker({
                        'scrollDefault': 'now',
                        'step': 10,
                        'minTime': self.$root.globals[0],
                        'maxTime': self.$root.globals[1]
                    });
                    $('#offsite-modal #offsite-location').autocomplete({
                        source: self.$root.locations,
                        minLength: 0
                    }).focus(function () {
                        $(this).data("uiAutocomplete").search($(this).val());
                    });
                })
                .catch(function (error) {
                    console.error('Request failed: [' + error + ']');
                    self.$root.errorMessage('Fetching data failed. Please try again, or speak to a developer.');
                });
        },
        errorMessage: function (message) {
            //make this a message at the top of the page instead of an alert
            alert(message);
        },
        changeStatus: function (status, returnTime, info) {
            selected = this.$root.selected;
            self = this;
            if (selected.length > 0) {
                let q = './backend/request.php?f=changestatus&status=' + status + '&students=' + selected.join();
                if (returnTime) q += '&returntime=' + returnTime;
                if (info) q += '&info=' + info;
                axios.get(q)
                    .then(function (response) {
                        //eventually make it so it doesn't need to reload the whole table - just the statuses that changed
                        alert(response.data);
                        self.$root.selected = [];
                        $('.modal').css('display', 'none');
                        $('.modal input[type="text"]').val('');
                        self.$root.load();
                    })
                    .catch(function (error) {
                        self.$root.errorMessage('Could not perform the action. Try again, or speak to a developer.');
                    });
            } else {
                this.$root.errorMessage('You must select at least one student!');
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