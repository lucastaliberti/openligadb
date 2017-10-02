import React from 'react';

import Team from '../../components/Team'

export default ({title, data: {loading, error, teams}}) =>
  (
    <div className="col-md-4">
      <div className="panel panel-default">
        <div className="panel-heading">{title}</div>

        <div className="panel-body">
          {loading && <p>Loading ...</p>}

          {error && <p>{error.message}</p>}

          {!loading && !error && teams.map(t =>
            <Team
              key={t.TeamName}
              name={t.TeamName}
              icon={t.TeamIconUrl}
              win={t.Win}
              loss={t.Loss}
              winratio={t.WinRatio}
            />
          )}
        </div>
      </div>
    </div>
  )

