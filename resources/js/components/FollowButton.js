import React from 'react';
import ReactDOM from 'react-dom';
import {useState} from "react";

let $follows = document.getElementById('follow-button').getAttribute('follows');

function FollowButton() {
    const [follow,setFollow] = useState($follows ? true : false);
    function followUser(){
        const userid = document.getElementById('follow-button').getAttribute('userid');
        axios.post('/follow/'+ userid)
            .then(response => {
                setFollow(!follow);
               // console.log(response.data);
                // console.log($follows);
            })
            .catch(errors =>{
                if (errors.response.status === 401){
                    window.location = '/login';
                }
            })
    }
    return (
        <React.Fragment>
            <button className="btn btn-primary ms-4"
                    userid={document.getElementById('follow-button').userid}
                    onClick={() => {followUser()}}>{follow ? 'Unfollow': 'Follow'}
            </button>
        </React.Fragment>
    );
}

export default FollowButton;


if (document.getElementById('follow-button')) {
    ReactDOM.render(<FollowButton />, document.getElementById('follow-button'));
}
