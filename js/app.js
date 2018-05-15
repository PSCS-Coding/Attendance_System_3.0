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
                {{ firstName }} {{ [...lastName][0] }}. is {{ $root.statusData[status] }}
                <span v-if='info'> at/with {{ info }}, returning at {{ returnTime }}</span>
            </label>
        </div>`
});

Vue.component('student-list', {
    template: `
        <div class='student-list'>
            <student v-for='student of $root.students' :key='student.studentId' :student-id='student.studentId' :first-name='student.firstName' :last-name='student.lastName' :status='student.status' :return-time='student.returnTime' :info='student.info'></student>
        </div>`
});

//for now I'm putting them in manually, eventually we'll fetch all this from the database of course

var vm = new Vue({
    el: '#attendance',
    data: {
        students: [{ //will be a blank array
                studentId: 1,
                firstName: 'Eli',
                lastName: 'Kimchi',
                status: 2,
                returnTime: '3:10pm',
                info: 'Uwajimaya'
            },
            {
                studentId: 2,
                firstName: 'Anthony',
                lastName: 'Reyes',
                status: 7
            }
        ],
        statusData: [ //will be a blank array
            'Not Checked In',
            'Present',
            'Offsite',
            'Field Trip',
            'Checked Out',
            'Late',
            'Independent Study',
            'Absent'
        ],
        selected: []
    },
    methods: {
        /*
        load: function() {
            //get student info from the database and create an object for each student in the students array
            //get status info from the database and put it into the statusData array
            //get current info
        }
        */
    }
    /*,
        beforeMount() {
            //create a global load function that fetches students and their data from the db, as well as status data and info from the current table.
            this.load();
        },
        mounted() {
            //create a general purpose listen (name?) function that will listen for anything that needs to be dealing with the database.
            this.listen();
        }*/
});