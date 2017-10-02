import React from 'react';

import Match from '../../components/Match'

export default ({title, data: {loading, error, upcoming}}) =>
  (
    <div className="col-md-4">
      <div className="panel panel-default">
        <div className="panel-heading">{title}</div>

        <div className="panel-body">
          {loading && <p>Loading ...</p>}

          {error && <p>{error.message}</p>}

          {!loading && !error && upcoming.map(mt =>
            <Match match={mt} key={mt.MatchID}/>
          )}
        </div>
      </div>
    </div>
  )
