import React from 'react';
import Team from '../Team'
import * as moment from 'moment';

export default ({match}) =>
  (
    <div key={match.MatchID}>
      <div className="row">
        <div className="col-md-12">
          {moment(match.MatchDateTime).format("dddd, MMMM Do YYYY, h:mm:ss a")}
        </div>
      </div>
      <div className="row">
        <div className="col-md-5">
          <Team name={match.Team1.TeamName} icon={match.Team1.TeamIconUrl}/>
        </div>
        <div className="col-md-2">X</div>
        <div className="col-md-5">
          <Team name={match.Team2.TeamName} icon={match.Team2.TeamIconUrl}/>
        </div>
      </div>
    </div>
  )
