<?php

// [membershipType] --> 1 = XBL, 2 = PSN
// [accountId] --> membershipID

//endpoints and example URLs to pull info from:

// searches for a destiny player by their name
// RETURNS:
// - iconpath (psn, xbl)
// - membershipType (1 = xbl, 2 = psn)
// - membershipID: unique ID of the player
// - displayName of the player
// 
// http://www.bungie.net/platform/Destiny/SearchDestinyPlayer/2/jaytwitch/

// REQUIRES WebAuth
// http://www.bungie.net/platform/Destiny/2/Account/4611686018433058403/Character/2305843009215534555/Complete/

// http://www.bungie.net/platform/Destiny/Manifest/
// http://www.bungie.net/platform/Destiny/Manifest/[i]/[j]/
// http://www.bungie.net/platform/Destiny/SearchDestinyPlayer/[d]/[e]/
// http://www.bungie.net/platform/Destiny/[membershipType]/Account/[accountId]/
// http://www.bungie.net/platform/Destiny/[e]/Account/[d]/Character/[g]/
// http://www.bungie.net/platform/Destiny/[membershipType]/Account/[accountId]/Character/[characterId]/Complete/
// http://www.bungie.net/platform/Destiny/[membershipType]/Account/[d]/Character/[g]/Inventory/
// http://www.bungie.net/platform/Destiny/[membershipType]/Account/[d]/Character/[h]/Inventory/[e]/
// http://www.bungie.net/platform/Destiny/[membershipType]/Account/[d]/Character/[g]/Activities/
// http://www.bungie.net/platform/Destiny/[membershipType]/Account/[d]/Character/[g]/Progression/
// http://www.bungie.net/platform/Destiny/[membershipType]/MyAccount/Character/[characterId]/Vendors/
// http://www.bungie.net/platform/Destiny/[membershipType]/MyAccount/Character/[characterId]/Vendors/Summaries/
// http://www.bungie.net/platform/Destiny/[membershipType]/MyAccount/Character/[characterId]/Vendor/[g]/
// http://www.bungie.net/platform/Destiny/[d]/MyAccount/Character/[f]/Advisors/
// http://www.bungie.net/platform/Destiny/EquipItem/
// http://www.bungie.net/platform/Destiny/Stats/Definition/
// http://www.bungie.net/platform/Destiny/Stats/[e]/[d]/[f]/
// http://www.bungie.net/platform/Destiny/Stats/ActivityHistory/[f]/[e]/[g]/
// http://www.bungie.net/platform/Destiny/Stats/UniqueWeapons/[f]/[d]/[g]/
// http://www.bungie.net/platform/Destiny/Stats/Leaderboards/[e]/[d]/
// http://www.bungie.net/platform/Destiny/Stats/LeaderboardsForPsn/
// http://www.bungie.net/platform/Destiny/Stats/Leaderboards/[e]/[d]/[f]/
// http://www.bungie.net/platform/Destiny/Stats/PostGameCarnageReport/[e]/
// http://www.bungie.net/platform/Destiny/Stats/AggregateActivityStats/[f]/[e]/[g]/
// http://www.bungie.net/platform/Destiny/[d]/Stats/GetMembershipIdByDisplayName/[e]/
// http://www.bungie.net/platform/Destiny/Vanguard/Grimoire/[d]/
// http://www.bungie.net/platform/Destiny/Vanguard/Grimoire/[d]/[e]/
// http://www.bungie.net/platform/Destiny/Vanguard/Grimoire/Definition/

// FULL LIST OF ENDPOINTS

// USER RELATED
// 
// http://www.bungie.net/platform/JSONP/GetBungieNetUser/
// http://www.bungie.net/platform/User/CreateUser/
// http://www.bungie.net/platform/User/UpdateUser/
// http://www.bungie.net/platform/User/UpdateUserAdmin/[d]/
// http://www.bungie.net/platform/User/Notification/Update/
// http://www.bungie.net/platform/User/MessageFlags/Success/Update/[f]/
// http://www.bungie.net/platform/User/GetBungieNetUser/
// http://www.bungie.net/platform/User/GetCounts/
// http://www.bungie.net/platform/User/GetBungieNetUserById/[userId]/
// http://www.bungie.net/platform/User/GetUserAliases/[userId]/
// http://www.bungie.net/platform/User/SearchUsers/
// http://www.bungie.net/platform/User/GetBungieAccount/[h]/[g]/
// http://www.bungie.net/platform/User/SearchUsersPaged/[searchTerm]/[page]/
// http://www.bungie.net/platform/User/SearchUsersPaged/[h]/[i]/[g]/
// http://www.bungie.net/platform/User/GetNotificationSettings/
// http://www.bungie.net/platform/User/GetCredentialTypesForAccount/
// http://www.bungie.net/platform/User/GetAvailableAvatars/
// http://www.bungie.net/platform/User/GetAvailableAvatarsAdmin/[g]/
// http://www.bungie.net/platform/User/GetAvailableThemes/
// http://www.bungie.net/platform/User/RegisterMobileAppPair/
// http://www.bungie.net/platform/User/UnregisterMobileAppPair/[d]/
// http://www.bungie.net/platform/User/UpdateStateInfoForMobileAppPair/
// http://www.bungie.net/platform/User/GetMobileAppPairings/
// http://www.bungie.net/platform/User/GetMobileAppPairingsUncached/
// http://www.bungie.net/platform/User/GetSignOutUrl/
// http://www.bungie.net/platform/User/DemonwareLinkOverride/
// http://www.bungie.net/platform/User/GetMembershipIds/
// http://www.bungie.net/platform/User/Acknowledged/[e]/


// MESSAGES RELATED
// 
// http://www.bungie.net/platform/Message/GetConversationByIdV2/[conversationId]/
// http://www.bungie.net/platform/Message/GetConversationWithMemberV2/[memberId]/
// http://www.bungie.net/platform/Message/GetConversationThreadV3/[d]/[h]/
// http://www.bungie.net/platform/Message/SaveMessageV3/
// http://www.bungie.net/platform/Message/CreateConversation/
// http://www.bungie.net/platform/Message/GetConversationsV4/[g]/
// http://www.bungie.net/platform/Message/GetUnreadConversationCountV3/
// http://www.bungie.net/platform/Message/LeaveConversation/[d]/
// http://www.bungie.net/platform/Message/Invitations/ReviewListDirect/[d]/
// http://www.bungie.net/platform/Message/Invitations/ReviewAllDirect/[d]/[e]/
// http://www.bungie.net/platform/Message/Invitations/ReviewDirect/[e]/[d]/
// http://www.bungie.net/platform/Message/Invitations/[e]/[f]/[d]/
// http://www.bungie.net/platform/Message/AllianceInvitations/RequestsToJoinYourGroup/[d]/[g]/
// http://www.bungie.net/platform/Message/AllianceInvitations/InvitationsToJoinAnotherGroup/[d]/[g]/
// http://www.bungie.net/platform/Message/Invitations/[d]/Details/
// http://www.bungie.net/platform/Message/GetUnreadPrivateConversationCount/
// http://www.bungie.net/platform/Message/GetConversationById/[d]/
// http://www.bungie.net/platform/Message/GetConversationWithMember/[d]/
// http://www.bungie.net/platform/Message/SaveMessageV2/
// http://www.bungie.net/platform/Message/GetConversationsV2/[g]/[d]/
// http://www.bungie.net/platform/Message/GetConversationsV3/[g]/[d]/
// http://www.bungie.net/platform/Message/GetConversationThreadV2/[d]/[h]/[e]/
// http://www.bungie.net/platform/Notification/GetRecent/
// http://www.bungie.net/platform/Notification/GetCount/
// http://www.bungie.net/platform/Notification/Reset/
// http://www.bungie.net/platform/Content/GetContentType/[h]/
// http://www.bungie.net/platform/Content/GetContentById/[j]/[g]/
// http://www.bungie.net/platform/Content/GetContentByTagAndType/[k]/[j]/[g]/
// http://www.bungie.net/platform/Content/SearchEx/[e]/
// http://www.bungie.net/platform/Content/Search/[i]/
// http://www.bungie.net/platform/Content/SearchContentByTagAndType/[m]/[l]/[i]/
// http://www.bungie.net/platform/Content/Site/Homepage/[g]/
// http://www.bungie.net/platform/Content/Site/Jobs/[g]/
// http://www.bungie.net/platform/Content/Site/News/[i]/[j]/
// http://www.bungie.net/platform/Content/Site/Destiny/[g]/
// http://www.bungie.net/platform/Content/Site/Destiny/V2/[g]/
// http://www.bungie.net/platform/ExternalSocial/GetAggregatedSocialFeed/[i]/
// http://www.bungie.net/platform/Survey/GetSurvey/
// http://www.bungie.net/platform/Forum/CreatePost/
// http://www.bungie.net/platform/Forum/CreateContentComment/
// http://www.bungie.net/platform/Forum/EditPost/[e]/
// http://www.bungie.net/platform/Forum/DeletePost/[e]/
// http://www.bungie.net/platform/Forum/RatePost/[e]/[f]/
// http://www.bungie.net/platform/Forum/UndoRating/[e]/
// http://www.bungie.net/platform/Forum/Post/[e]/Moderate/
// http://www.bungie.net/platform/Forum/Tags/[e]/Moderate/
// http://www.bungie.net/platform/Forum/Post/[e]/GroupModerate/
// http://www.bungie.net/platform/Forum/GetTopicsPagedForAlliance/[k]/[g]/[j]/[l]/[f]/[d]/
// http://www.bungie.net/platform/Forum/GetTopicsPaged/[k]/[g]/[j]/[l]/[f]/[d]/
// http://www.bungie.net/platform/Forum/GetPopularTopicsAnonymously/
// http://www.bungie.net/platform/Forum/GetPostsThreadedPaged/[f]/[m]/[i]/[h]/[e]/[d]/[j]/
// http://www.bungie.net/platform/Forum/GetPostsThreadedPagedFromChild/[e]/[k]/[g]/[f]/[d]/[h]/
// http://www.bungie.net/platform/Forum/GetPostAndParent/[g]/
// http://www.bungie.net/platform/Forum/GetPopularTags/
// http://www.bungie.net/platform/Forum/GetForumTagCountEstimate/[g]/
// http://www.bungie.net/platform/Forum/GetTopicForContent/[g]/
// http://www.bungie.net/platform/Forum/GetForumTagSuggestions/
// http://www.bungie.net/platform/Forum/MarkReplyAsAnswer/[d]/[e]/
// http://www.bungie.net/platform/Forum/Poll/Vote/[f]/[d]/
// http://www.bungie.net/platform/Forum/Poll/[e]/
// http://www.bungie.net/platform/Activity/Aggregation/
// http://www.bungie.net/platform/Activity/Following/
// http://www.bungie.net/platform/Activity/Following/Groups/
// http://www.bungie.net/platform/Activity/User/[f]/Following/Groups/
// http://www.bungie.net/platform/Activity/User/[d]/Following/Groups/Paged/[e]/
// http://www.bungie.net/platform/Activity/User/[f]/Following/
// http://www.bungie.net/platform/Activity/User/[h]/Followers/
// http://www.bungie.net/platform/Activity/User/[f]/Follow/
// http://www.bungie.net/platform/Activity/User/[f]/Unfollow/
// http://www.bungie.net/platform/Activity/User/[i]/Activities/LikesAndShares/
// http://www.bungie.net/platform/Activity/User/[h]/Activities/LikesAndSharesV2/
// http://www.bungie.net/platform/Activity/User/[i]/Activities/Forums/
// http://www.bungie.net/platform/Activity/User/[h]/Activities/ForumsV2/
// http://www.bungie.net/platform/Activity/Group/[h]/Followers/
// http://www.bungie.net/platform/Activity/Group/[f]/Follow/
// http://www.bungie.net/platform/Activity/Group/[f]/Unfollow/
// http://www.bungie.net/platform/Activity/Group/[g]/Activities/
// http://www.bungie.net/platform/Activity/Tag/Followers/
// http://www.bungie.net/platform/Activity/Tag/Follow/
// http://www.bungie.net/platform/Activity/Tag/Unfollow/
// http://www.bungie.net/platform/Activity/Friends/
// http://www.bungie.net/platform/Activity/Friends/AllNoPresence/[d]/
// http://www.bungie.net/platform/Activity/Friends/Paged/[d]/[e]/
// http://www.bungie.net/platform/Group/GetAvailableAvatars/
// http://www.bungie.net/platform/Group/GetAvailableThemes/
// http://www.bungie.net/platform/Group/[d]/FollowedBy/[f]/
// http://www.bungie.net/platform/Group/[d]/Following/[f]/
// http://www.bungie.net/platform/Group/[e]/Follow/[d]/
// http://www.bungie.net/platform/Group/[e]/Unfollow/[d]/
// http://www.bungie.net/platform/Group/[d]/FollowList/
// http://www.bungie.net/platform/Group/[d]/UnfollowList/
// http://www.bungie.net/platform/Group/[d]/UnfollowAll/
// http://www.bungie.net/platform/Group/[d]/Allies/Invite/[e]/
// http://www.bungie.net/platform/Group/[d]/Allies/InviteMany/
// http://www.bungie.net/platform/Group/[e]/Allies/RequestToJoin/[d]/
// http://www.bungie.net/platform/Group/[d]/Relationship/[e]/BreakAlliance/
// http://www.bungie.net/platform/Group/[d]/BreakAlliances/
// http://www.bungie.net/platform/Group/[d]/BreakAllAlliances/
// http://www.bungie.net/platform/Group/[d]/SetAsAlliance/
// http://www.bungie.net/platform/Group/[f]/Allies/
// http://www.bungie.net/platform/Group/MyGroups/Recommended/[f]/
// http://www.bungie.net/platform/Group/Search/
// http://www.bungie.net/platform/Group/MyGroups/
// http://www.bungie.net/platform/Group/MyGroups/V2/[e]/
// http://www.bungie.net/platform/Group/MyPendingGroups/
// http://www.bungie.net/platform/Group/MyPendingGroups/V2/[e]/
// http://www.bungie.net/platform/Group/MyGroups/All/
// http://www.bungie.net/platform/Group/MyGroups/Deleted/
// http://www.bungie.net/platform/Group/User/[e]/
// http://www.bungie.net/platform/Group/User/[e]/Joined/[f]/
// http://www.bungie.net/platform/Group/User/[e]/Pending/
// http://www.bungie.net/platform/Group/User/[e]/PendingV2/[f]/
// http://www.bungie.net/platform/Group/User/[e]/All/
// http://www.bungie.net/platform/Group/[e]/
// http://www.bungie.net/platform/Group/Name/[e]/
// http://www.bungie.net/platform/Group/GetGroupTagSuggestions/
// http://www.bungie.net/platform/Group/Create/
// http://www.bungie.net/platform/Group/Create/Minimal/
// http://www.bungie.net/platform/Group/[d]/Edit/
// http://www.bungie.net/platform/Group/[d]/EditV2/
// http://www.bungie.net/platform/Group/[e]/Privacy/[d]/
// http://www.bungie.net/platform/Group/[d]/Undelete/
// http://www.bungie.net/platform/Group/[e]/Invite/[d]/
// http://www.bungie.net/platform/Group/[f]/InviteToClan/[d]/[e]/
// http://www.bungie.net/platform/Group/[f]/Members/Pending/
// http://www.bungie.net/platform/Group/[e]/Members/PendingV2/
// http://www.bungie.net/platform/Group/[e]/Members/Apply/
// http://www.bungie.net/platform/Group/[e]/Members/ApplyV2/
// http://www.bungie.net/platform/Group/[e]/Members/Rescind/
// http://www.bungie.net/platform/Group/[e]/Members/[d]/Approve/
// http://www.bungie.net/platform/Group/[e]/Members/[d]/ApproveV2/
// http://www.bungie.net/platform/Group/[e]/Members/[d]/Deny/
// http://www.bungie.net/platform/Group/[e]/Members/[d]/DenyV2/
// http://www.bungie.net/platform/Group/[d]/Members/ApproveAll/
// http://www.bungie.net/platform/Group/[d]/Members/DenyAll/
// http://www.bungie.net/platform/Group/[d]/Members/ApproveList/
// http://www.bungie.net/platform/Group/[d]/Members/DenyList/
// http://www.bungie.net/platform/Group/GetClanAttributeDefinitions/
// http://www.bungie.net/platform/Group/[e]/Clans/Enable/[d]/
// http://www.bungie.net/platform/Group/[e]/Clans/Join/[d]/
// http://www.bungie.net/platform/Group/[e]/Clans/Leave/[d]/
// http://www.bungie.net/platform/Group/[e]/Clans/Disable/[d]/
// http://www.bungie.net/platform/Group/MyClans/Refresh/[d]/
// http://www.bungie.net/platform/Group/[groupId]/Members/
// http://www.bungie.net/platform/Group/[h]/MembersV2/
// http://www.bungie.net/platform/Group/[i]/MembersV3/
// http://www.bungie.net/platform/Group/[f]/Admins/
// http://www.bungie.net/platform/Group/[f]/AdminsV2/
// http://www.bungie.net/platform/Group/[f]/Members/[e]/SetMembershipType/[d]/
// http://www.bungie.net/platform/Group/[e]/Members/[d]/Kick/
// http://www.bungie.net/platform/Group/[e]/Members/[d]/Ban/
// http://www.bungie.net/platform/Group/[e]/Members/[d]/Unban/
// http://www.bungie.net/platform/Group/[groupId]/Banned/
// http://www.bungie.net/platform/Group/[groupId]/BannedV2/
// http://www.bungie.net/platform/Group/[groupId]/Admin/FounderOverride/[d]/
// http://www.bungie.net/platform/Ignore/MyIgnores/Posts/[e]/
// http://www.bungie.net/platform/Ignore/MyIgnores/Users/[d]/
// http://www.bungie.net/platform/Ignore/MyIgnores/
// http://www.bungie.net/platform/Ignore/Ignore/
// http://www.bungie.net/platform/Ignore/Unignore/
// http://www.bungie.net/platform/Ignore/MyLastReport/
// http://www.bungie.net/platform/Game/GetPlayerGamesById/[d]/
// http://www.bungie.net/platform/Game/ReachModelSneakerNet/[f]/
// http://www.bungie.net/platform/Admin/Assigned/
// http://www.bungie.net/platform/Admin/Assigned/Resolve/
// http://www.bungie.net/platform/Admin/Reports/Overturn/
// http://www.bungie.net/platform/Admin/Member/[d]/Reports/
// http://www.bungie.net/platform/Admin/Reports/
// http://www.bungie.net/platform/Admin/Ignores/GloballyIgnore/
// http://www.bungie.net/platform/Admin/Member/[d]/SetBan/
// http://www.bungie.net/platform/Admin/Ignores/OverrideGlobalIgnore/
// http://www.bungie.net/platform/Admin/Member/Search/
// http://www.bungie.net/platform/Bugs/Unreviewed/
// http://www.bungie.net/platform/Bugs/Bug/[e]/
// http://www.bungie.net/platform/Bugs/Create/
// http://www.bungie.net/platform/Bugs/Bug/[e]/Reject/
// http://www.bungie.net/platform/Bugs/Bug/[f]/Approve/[e]/
// http://www.bungie.net/platform/Bugs/Bug/[e]/Attach/
// http://www.bungie.net/platform/Bugs/Stats/Report/
// http://www.bungie.net/platform/Tokens/Claim/
// http://www.bungie.net/platform/Tokens/OfferHistory/
// http://www.bungie.net/platform/Tokens/ThrottleState/
// http://www.bungie.net/platform/Tokens/VerifyAge/
// http://www.bungie.net/platform/Tokens/ConsumeMarketplacePlatformCodeOffer/[e]/[d]/[f]/
// http://www.bungie.net/platform/Tokens/MarketplacePlatformCodeOfferHistory/
// http://www.bungie.net/platform/Tokens/ApplyOffersToCurrentDestinyMembership/[d]/
// http://www.bungie.net/platform/Tokens/DestinyUnlockHistory/[d]/

// http://www.bungie.net/platform//HelloWorld/
// http://www.bungie.net/platform//CacheTest/
// http://www.bungie.net/platform//TestUnhandledError/
// http://www.bungie.net/platform//GetAvailableLocales/
// http://www.bungie.net/platform//Settings/
// http://www.bungie.net/platform//GlobalAlert/
// http://www.bungie.net/platform/Content/Representation/GetRepresentationsForType/" + b.contentType + "/" + b.locale + "/
// http://www.bungie.net/platform/Content/Search/" + b.locale + "/
// http://www.bungie.net/platform/Content/GetContentById/" + b.contentId + "/" + b.locale + "/