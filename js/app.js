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
                {{ firstName }} {{ [...lastName][0] }} | {{ $root.statusData[status] }}
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

Vue.component('main-navbar', {
    template: `
        <nav>
            <ul>
                <li><a href='#' @click='changeStatus("1")'>Present</a></li>
                <li><a href='#' @click='modal("#offsite-modal")'>Offsite</a></li>
                <li><a href='#' @click='modal("#late-modal")'>Late</a></li>
                <li><a href='#' @click='modal("#field-trip-modal")'>Field trip</a></li>
            </ul>
        </nav>`,
    methods: {
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
                        self.$root.load();
                    })
                    .catch(function (error) {
                        self.$root.errorMessage('Could not perform the action. Try again, or speak to a developer.');
                    });
            } else {
                this.$root.errorMessage('You must select at least one student!');
            }
        },
        modal: function (modalId) {
            if ($(modalId).length > 0) {

                $(modalId).css('display', 'block');

                $(modalId + ' .close').click(function () {
                    $(modalId).css('display', 'none');
                });

                $(window).click(function (event) {
                    if ($(modalId).is(event.target)) {
                        $(modalId).css('display', 'none');
                    }
                });
            } else {
                console.error('A valid id must be provided as the first parameter of modal()');
            }
        }
    }
});

var vm = new Vue({
    el: '#attendance',
    data: {
        students: [],
        statusData: [],
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
                })
                .catch(function (error) {
                    console.log('Request failed: [' + error + ']');
                    alert('Fetching data failed. Please try again, or speak to a developer.');
                });
        },
        errorMessage: function (message) {
            //make this a message at the top of the page instead of an alert
            alert(message);
        }
    },
    beforeMount() {
        this.load();
        feather.replace();
    },
    mounted() {
        //put a function here that listens for status changes, etc. Basically any listeners
    }
});