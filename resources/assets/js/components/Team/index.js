import React from 'react';

export default ({name, icon, win, loss, winratio}) =>
  (
    <div className="thumbnail team">
      <img src={icon} alt={name}/>
      <div className="caption">
        <span className="text-center">{name}</span>
      </div>
      {win && loss && winratio &&
      <div className="row">
        <div className="col-md-4">{win} wins</div>
        <div className="col-md-4">{loss} losses</div>
        <div className="col-md-4">{winratio.toFixed(2)}% win ratio</div>
      </div>
      }
    </div>
  )
