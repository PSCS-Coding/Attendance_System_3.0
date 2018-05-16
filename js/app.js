Vue.component('student', {
    props: {
        studentId: Number,
        firstName: String,
        lastName: String,
        returnTime: String,
        info: String,
        status: Number
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
            axios.get('../backend/request.php?f=current')
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
                            status: parseInt(student.status_id),
                            returnTime: student.return_time,
                            info: student.info
                        }));
                    });
                    self.$root.students = studentList;
                })
                .catch(function (error) {
                    console.log('Request failed: [' + error + ']');
                    alert('Fetching data failed. Please try again, or speak to a developer.');
                });
        }
    },
    beforeMount() {
        this.load();
    },
    mounted() {
        //put a function here that listens for status changes, etc. Basically any listeners
    }
});