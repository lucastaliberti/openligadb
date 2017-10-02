import React, {Component} from 'react'

import Header from '../../components/Header'
import AllMatches from '../AllMatches'
import TeamRatio from '../TeamRatio'
import UpcomingMatches from '../UpcomingMatches'

import {
  ApolloClient,
  gql,
  graphql,
  ApolloProvider,
} from 'react-apollo';

const client = new ApolloClient();

const allMatchesQuery = gql`
   query FetchAll {
      matches {
        MatchID
        MatchDateTime
        Team1 {
          TeamName
          TeamIconUrl
        }
        Team2 {
          TeamName
          TeamIconUrl
        }
      } 
    }
 `;
const AllMatchesWithData = graphql(allMatchesQuery)(AllMatches);


const upcomingMatchesQuery = gql`
   query FetchUpcoming {
      upcoming {
        MatchID
        MatchDateTime
        Team1 {
          TeamName
          TeamIconUrl
        }
        Team2 {
          TeamName
          TeamIconUrl
        }
      } 
    }
 `;
const UpcomingMatchesWithData = graphql(upcomingMatchesQuery)(UpcomingMatches);

const teamRatioQuery = gql`
   query FetchTeams {
    teams {
      TeamName
      TeamIconUrl
      Win
      Loss
      TotalGames
      WinRatio
      LossRatio
    }
  }
 `;
const TeamRatioWithData = graphql(teamRatioQuery)(TeamRatio);

export default class App extends Component {
  constructor(props){
    super(props)
  }

  render() {
    return (
      <ApolloProvider client={client}>
      <div className="container">
        <Header/>
        <div className="row">
          <AllMatchesWithData title="All matches of the league"/>
          <TeamRatioWithData title="Teams ratio"/>
          <UpcomingMatchesWithData title="Upcoming"/>
        </div>
      </div>
      </ApolloProvider>
    )
  }
}