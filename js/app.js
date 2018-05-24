Vue.component('student', {
    props: {
        studentId: Number,
        firstName: String,
        lastName: String,
        returnTime: Object,
        info: String,
        status: String
    },
    template: `
        <label :for='studentId' :class='{ "late-shading": textRed, "selected": isSelected, "card": true}' @toggle-selected='selected()'>
            <input type='checkbox' :value='studentId' :id='studentId' v-model='$root.selected' hidden>
            <div class='card-content'>
                <a href='#' class='name hoverAnimation'>{{ firstName }} {{ [...lastName][0] }}.</a>
                <div class='location'>{{ $root.statusData[status] }} </div>
                <p class='info' v-if='returnTime'> <span v-if='info'>{{ info }} </span> returning at {{ fmtReturnTime }}</p>
            </div>
        </label>`,
    computed: {
        fmtReturnTime: function () {
            if (this.returnTime) {
                return this.returnTime.format('h:mma').toString();
            }
        },
        textRed: function () {
            return (this.returnTime && this.returnTime.isBefore(moment())) || (moment().isAfter(this.$root.globals.startTime) && this.status == '0') ? true : false;
        },
        isSelected: function () {
            return this.$root.selected.find(x => x == this.studentId) == this.studentId ? true : false;
        }
    }
});

Vue.component('group', {
    props: {
        groupName: String,
        students: Array
    },
    template: `
        <div class='group'>
            <input type='checkbox' :value='groupName' :id='groupId' @change='group()' v-model='$root.selectedGroups'>
            <label :for='groupId'>
                {{groupName}}
            </label>
        </div>`,
    computed: {
        groupId: function () {
            return 'group-' + this.groupName;
        }
    },
    methods: {
        group: function () {
            if ($('.group #' + this.groupId).prop('checked')) {
                let add = this.students;
                add = add.concat(this.$root.selected);
                this.$root.selected = _.uniq(add);
            } else {
                let remove = this.students;
                this.$root.selected = _.differenceWith(this.$root.selected, remove, _.isEqual);
                let allAdd;
                for (let i = 0; i < this.$root.selectedGroups.length; i++) {
                    allAdd = this.$root.groups.find(x => x.name == this.$root.selectedGroups[i]).students;
                    allAdd = allAdd.concat(this.$root.selected);
                    this.$root.selected = _.uniq(allAdd);
                }
            }
        }
    }
});

Vue.component('groups-select', {
    template: `
        <div class='groups-select'>
        <p>groups</p>
            <group v-for='group of $root.groups' :key='group.name' :group-name='group.name' :students='group.students'></group>
        </div>`
});

Vue.component('student-list', {
    template: `
        <div class='container'>
            <div class='student-list flex-container'>
                <student @tog-selected='test()' v-for='student of $root.students' :key='student.studentId' :student-id='student.studentId' :first-name='student.firstName' :last-name='student.lastName' :status='student.status' :return-time='student.returnTime' :info='student.info'></student>
            </div>
        </div>`
});

Vue.component('offsite-modal', {
    template: `
        <div id="offsite-modal" class="modal">
            <div class="modal-content">
                <i class='close' data-feather="x"></i>
               <input type='text' id='offsite-location' placeholder='Location'>
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
               <input type='text' id='field-trip-facilitator' placeholder='Facilitator'>
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
            <ul class='navbar'>
                <span v-show='$root.selected.length > 0'>
                    <li><a href='#' @click='present()'>Present</a></li>
                    <li><a href='#' @click='modal("#offsite-modal")'>Offsite</a></li>
                    <li><a href='#' @click='modal("#late-modal")'>Late</a></li>
                    <li><a href='#' @click='modal("#field-trip-modal")'>Field trip</a></li>
                </span>
                <li class='pull-right'><a class='button' href='user.html'>User Page</a></li>
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
        selected: [],
        selectedGroups: []
    },
    watch: {
        selected: function (val) {
            let self = this;
            let studentsInGroup;
            let selectedStudents;
            this.$root.selectedGroups.forEach(name => {
                studentsInGroup = self.$root.groups.find(x => x.name == name).students;
                selectedStudents = self.$root.selected;
                //if the difference between the selected students in the group and the students in the group IS the selected students in the group
                //eg. if no students in a group are selected
                if (_.isEqual(_.difference(studentsInGroup, selectedStudents).sort(), studentsInGroup.sort())) {
                    //deselect that group
                    self.$root.selectedGroups.splice(_.indexOf(self.$root.selectedGroups, name), 1);;
                }
            });
        }
    },
    methods: {
        load: function () {
            let self = this;
            axios.get('./backend/request.php?f=current')
                .then(function (response) {
                    const decodedGlobals = decodeURIComponent((response.data.split('/')[4] + '').replace(/\+/g, '%20'));
                    const decodedGroups = decodeURIComponent((response.data.split('/')[5] + '').replace(/\+/g, '%20'));
                    let studentList = [];
                    //statuses
                    self.$root.statusData = decodeAndParse(response.data.split('/')[0] + '');
                    //students array
                    decodeAndParse(response.data.split('/')[1] + '').forEach(student => {
                        studentList.push(_.pickBy({
                            firstName: student.first_name,
                            lastName: student.last_name,
                            studentId: parseInt(student.student_id),
                            status: student.status_id,
                            returnTime: student.return_time == '00:00:00' ? null : moment(student.return_time, 'HH:mm:ss'),
                            info: student.info
                        }));
                    });
                    studentList.sort(function (a, b) {
                        return (a.firstName > b.firstName) ? 1 : ((b.firstName > a.firstName) ? -1 : 0);
                    });
                    self.$root.students = studentList;
                    self.$root.locations = Object.values(decodeAndParse(response.data.split('/')[2] + ''));
                    self.$root.facilitators = Object.values(decodeAndParse(response.data.split('/')[3] + ''));
                    globalsArray = Object.values(decodeAndParse(response.data.split('/')[4] + ''));
                    self.$root.globals = {
                        startTime: moment(globalsArray[0], 'HH:mm:ss'),
                        endTime: moment(globalsArray[1], 'HH:mm:ss')
                    }

                    groups = [];

                    decodeAndParse(response.data.split('/')[5] + '').forEach(group => {
                        groups.push({
                            name: group.group_name,
                            students: Object.values(group.students.map(function (x) {
                                return parseInt(x, 10);
                            }))
                        });
                    });

                    self.$root.groups = groups;

                    $('.timepicker').timepicker({
                        'scrollDefault': 'now',
                        'step': 10,
                        'minTime': self.$root.globals.startTime.toDate(),
                        'maxTime': self.$root.globals.endTime.toDate()
                    });
                    $('#offsite-modal #offsite-location').autocomplete({
                        source: self.$root.locations,
                        minLength: 0
                    }).focus(function () {
                        $(this).data("uiAutocomplete").search(null);
                    });

                    $('#field-trip-modal #field-trip-facilitator').autocomplete({
                        source: self.$root.facilitators,
                        minLength: 0
                    }).focus(function () {
                        $(this).data("uiAutocomplete").search(null);
                    });
                    $("#attendance").fadeIn();
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
                let usingReturn = false;
                if (returnTime) {
                    usingReturn = true;
                    q += '&returntime=' + returnTime;
                }
                if (info) q += '&info=' + info;

                if (!usingReturn || moment(returnTime, 'h:mma', true).isValid()) {
                    axios.get(q)
                        .then(function (response) {
                            //eventually make it so it doesn't need to reload the whole table - just the statuses that changed
                            self.$root.selected = [];
                            $('.modal').css('display', 'none');
                            $('.modal input[type="text"]').val('');
                            self.$root.load();
                        })
                        .catch(function (error) {
                            self.$root.errorMessage('Could not perform the action. Try again, or speak to a developer.');
                        });
                } else {
                    this.$root.errorMessage('You must enter a valid return time!');
                    $('.timepicker').val('');
                }
            } else {
                this.$root.errorMessage('You must select at least one student!');
            }
        },
        setIdle: function () {

            let self = this;
            let timer;

            function refresh() {
                clearTimeout(timer);
                timer = setTimeout(function () {
                    self.$root.load();
                    refresh();
                }, 10000);
            };

            refresh();

            $(document).on('keypress, click, mousemove', refresh);

        },
    },
    beforeMount() {
        this.load();
    },
    mounted() {
        this.setIdle();
        feather.replace();
    }
});