# Media Hub and Automation Strategy

## georgeungureanu.doctor

**Purpose of this document:** Define the complete media ecosystem and automation strategy for georgeungureanu.doctor. This document covers Phase 1 manual media curation and Phase 2 Make.com automation — the workflow by which social media content published by Dr. Ungureanu becomes candidate content for the website's Media Hub, after administrator review and approval.

**Governing constraints:**
- No live social feeds embedded on the website
- No automatic publishing — every piece of content requires a human editorial decision before appearing on the site
- No social metrics displayed (followers, likes, shares, view counts)
- No comments, no user accounts, no user-generated interactions on Media Hub content
- No third-party JavaScript from social platforms loaded on the website

**Relationship to prior tasks:**
- `docs/tasks/09_SFATUL_NEUROCHIRURGULUI.md` §12 introduced the Media Hub as Section 10 of the educational hub page and the Make.com automation at a high level. This document fully specifies both.
- `docs/tasks/02_CONTENT_MODELS.md` defines the Media Item CPT. This document defines the workflow that populates it.

**Source of truth:**
- `docs/tasks/00_PROJECT_ROADMAP.md` v1.1
- `docs/tasks/02_CONTENT_MODELS.md` v1.0
- `docs/tasks/09_SFATUL_NEUROCHIRURGULUI.md` v1.0
- `docs/project/PATIENT_CENTERED_MANIFESTO.md`
- `docs/content/CONTENT_TONE.md`
- `docs/design-system/BRAND_GUIDELINES.md`

---

# 1. Purpose of the Media Hub

## 1.1 What Problem It Solves

Dr. Ungureanu publishes educational content across YouTube, Instagram, and Facebook as part of the Sfatul Neurochirurgului brand. This content has value for patients visiting the website — but in its native platform form, it is inaccessible to patients who do not use those platforms, difficult to navigate for patients who want a specific topic, and embedded in a commercial, algorithmic environment that is inconsistent with this website's calm, patient-centered identity.

The Media Hub solves this by curating selected social media content into the website's own design system — making it accessible without requiring platform accounts, presenting it without platform-native metrics and recommendations, and organizing it editorially rather than algorithmically.

## 1.2 What the Media Hub Is

A manually or semi-automatically curated, locally-hosted collection of selected social media content from the official Sfatul Neurochirurgului channels on YouTube, Instagram, and Facebook. It is displayed on the /sfatul-neurochirurgului hub page as Section 10, within the site's standard design system.

**It is:**
- A selection of content, not a complete archive
- Controlled by an administrator, not by a platform algorithm
- Integrated into the site's visual system, not styled by a social platform's embed SDK
- Linked back to the originating post for patients who want the full context

**It is not:**
- A real-time mirror of the social channels
- An automated publication system
- A review or rating surface
- A social engagement mechanism (no likes, no comments, no shares from this page)

## 1.3 Why Patients Benefit from the Media Hub

A patient who does not use Instagram cannot access the educational content Dr. Ungureanu posts there. A patient who searches YouTube may not find specific short-form content buried in the channel. A patient who has been referred to the website by a colleague wants to find everything they need in one place without being redirected to multiple platforms.

The Media Hub surfaces relevant social content within the patient's existing browsing session, in a format that is consistent with the rest of the website, without requiring the patient to navigate away or create a social media account.

---

# 2. Relationship with Sfatul Neurochirurgului

## 2.1 Two Distinct Content Streams

The Sfatul Neurochirurgului section of the website contains two distinct content streams that must not be confused:

| Stream | What it is | CPT | Primary display location |
|--------|-----------|-----|--------------------------|
| SN Articles | Full written educational articles; some with an associated video | SN Article CPT | Featured content section (Section 3) + individual article pages |
| Media Items | Curated social media posts from Instagram, Facebook, YouTube | Media Item CPT | Media Hub (Section 10 of SN hub page) |

An SN Article may have an associated video (populated in the `video_url` field of the SN Article CPT) — that video is also available as a Media Item in the Videoclipuri section (Section 4). These are not duplicate entries — the SN Article provides written depth; the Media Item provides visual access. They reference the same YouTube video but serve different presentation contexts.

## 2.2 Media Item vs. SN Article — The Decision

When new content is created on a social platform, the administrator decides whether it should become:

1. **An SN Article** — if the content is substantive enough to stand alone as an educational piece with at least 300 words of written content and a patient-useful explanation of a medical topic. May also include the video.

2. **A Media Item only** — if the content is a short-form educational snippet, a visual explanation, a Q&A clip, or a post that is educational but not deep enough for a full article.

3. **Both** — an SN Article is created for the written depth, and the associated video is also added as a Media Item for the visual library.

4. **Neither** — if the social post is not appropriate for the website (too casual, too personal, references recent events that will date poorly, uses a register that doesn't match the site's editorial voice).

This decision is made by the administrator during the Draft approval process (Section 7).

## 2.3 Cross-Display Logic

Media Items are displayed in two locations:

| Location | Component | How many | Selection method |
|----------|-----------|----------|-----------------|
| SN hub page — Section 10 (Media Hub) | `organism-media-hub` | 12 most recently approved | Chronological by approval date, newest first |
| SN hub page — Section 4 (Videoclipuri) | `organism-video-grid` | Curated selection from YouTube Media Items only | Manual `display_order` field set by admin |

The same Media Item CPT entry can appear in both Sections 4 and 10 if it is a YouTube video. The CPT's `platform` field and `is_featured_video` boolean field determine which display locations pick up the entry.

---

# 3. Supported Platforms

## 3.1 YouTube

**Account type required:** YouTube channel (associated with a Google account)
**Content types covered:** Long-form videos, Shorts, Live recordings (after the live event ends and the recording becomes available)
**Primary content role:** Educational videos from Dr. Ungureanu — explanations, Q&A sessions, procedure overviews, patient preparation guides

**What is NOT captured from YouTube:**
- Community posts (YouTube community tab text posts) — not relevant to the website's educational mission
- Live chat transcripts — not suitable for website display
- YouTube Shorts created for platform-native viral reach, not for educational depth — admin decision at review

**YouTube technical requirements for Phase 2 automation:**
- YouTube Data API v3 access (read-only scope: `youtube.readonly`)
- OAuth 2.0 authentication on behalf of the channel owner (Dr. Ungureanu) OR a service account with channel read access
- Make.com YouTube module uses OAuth connection — credentials stored in Make, not on WordPress
- API quota: YouTube Data API v3 free tier provides 10,000 units per day; listing new videos costs 1 unit; downloading video metadata costs 1 unit per request; well within free tier limits for a single-channel monitoring scenario

**YouTube content fields available to the automation:**
- `id.videoId` — unique YouTube video ID (used to construct the watch URL)
- `snippet.title` — video title
- `snippet.description` — full video description
- `snippet.publishedAt` — ISO 8601 publication timestamp
- `snippet.thumbnails` — multiple resolution thumbnails (high-quality: 480×360px; maxres: 1280×720px where available)
- `contentDetails.duration` — video duration (ISO 8601 duration format, e.g., PT12M34S)

## 3.2 Instagram

**Account type required:** Instagram Business Account (not a personal account, not a Creator account) linked to a Facebook Business Page
**Content types covered:** Image posts, video posts, Reels, Carousel albums
**Primary content role:** Short-form educational visuals, anatomical diagrams, patient-focused infographics, Q&A clips

**What is NOT captured from Instagram:**
- Stories — they expire after 24 hours and are not stable website content. The Instagram Graph API does not reliably support Story archiving for Make automation. Stories are not included in Phase 2.
- Live videos — same instability problem as Stories
- Posts from personal accounts — the automation monitors only the Business Account associated with the Sfatul Neurochirurgului brand

**Instagram technical requirements for Phase 2 automation:**
- Instagram Business Account linked to a Facebook Business Manager
- Facebook App with Instagram Graph API permissions: `instagram_basic`, `instagram_manage_media`, `pages_read_engagement`
- Long-lived User Access Token (valid 60 days) OR Page Access Token (never expires if generated correctly) — stored in Make.com, not on WordPress
- **Critical:** Instagram Graph API tokens require active renewal. Long-lived tokens must be refreshed before the 60-day expiry. This is a routine maintenance task for the administrator. A dead token means the Instagram scenario stops working silently.

**Instagram content fields available to the automation:**
- `id` — unique Instagram media ID
- `media_type` — IMAGE, VIDEO, CAROUSEL_ALBUM, REEL
- `media_url` — direct URL to image/video (temporary; download immediately and store locally)
- `thumbnail_url` — thumbnail for VIDEO and REEL types (temporary; download immediately)
- `caption` — full post caption text
- `timestamp` — ISO 8601 publication timestamp
- `permalink` — permanent URL to the post on Instagram (stable)

**Instagram media URL stability note:** The `media_url` returned by the Instagram Graph API is a temporary CDN URL that expires. The Make scenario must download the image/video to a permanent location (WordPress media library) at the time the Make scenario runs — it cannot store the URL and download later.

## 3.3 Facebook

**Account type required:** Facebook Business Page (not a personal profile)
**Content types covered:** Status posts, photo posts, video posts, link posts
**Primary content role:** Longer educational text posts shared with an older demographic; video reposts from YouTube; community reach content

**What is NOT captured from Facebook:**
- Personal profile posts from Dr. Ungureanu's personal Facebook account — the automation monitors only the Business Page
- Events — not relevant for the Media Hub
- Ads — the page may run Facebook ads that are not editorial content; these must not be captured
- Comments and reactions — never captured or displayed
- Facebook Stories — same instability as Instagram Stories; not captured

**Facebook technical requirements for Phase 2 automation:**
- Facebook Business Page (verified)
- Facebook App with permissions: `pages_read_engagement`, `pages_read_user_content`
- Page Access Token for the specific Business Page — stored in Make.com
- **Page Access Tokens**: when generated correctly using a long-lived User Token, Page Access Tokens do not expire. Confirm this with Make.com documentation at time of Phase 2 implementation.

**Facebook content fields available to the automation:**
- `id` — unique post ID
- `message` — full post text
- `created_time` — ISO 8601 publication timestamp
- `permalink_url` — permanent URL to the post
- `attachments.data` — contains image URLs, video URLs, or link data depending on post type
- `story` — Facebook's auto-generated story text (e.g., "Dr. George Ungureanu shared a video") — this is NOT the post content; ignore it in the automation

**Facebook image URL stability:** Unlike Instagram, Facebook image URLs in the Graph API response are reasonably stable (they are CDN URLs that do not have short expiration). However, the Make scenario should still download and store images locally in the WordPress media library to avoid dependence on Facebook CDN availability and to prevent third-party tracking when images load.

---

# 4. Editorial Principles

## 4.1 Curation Is Always Human

No content appears on the website without an administrator's explicit decision to publish it. This applies in both Phase 1 (manual entry) and Phase 2 (Make automation creates Drafts, administrator approves). The automation does not reduce the administrator's decision-making authority — it reduces the manual data entry effort.

## 4.2 What Should Be Published in the Media Hub

Content is published in the Media Hub if it meets all of the following:

**Educational value:** The content teaches or informs — it explains a concept, answers a question, demonstrates a process, or helps a patient or family member understand something about neurosurgery, neurological conditions, or the patient experience. Content that is purely promotional, personal, or calendar-based ("Happy New Year!") does not qualify.

**Register consistency:** The content's tone is consistent with the website's editorial voice — calm, warm, direct, professional. A social post written for casual engagement ("Swipe to see the full answer! What do you think?") may need the caption rewritten for website display if the underlying content is valuable but the format is platform-specific.

**Medical accuracy:** Clinical claims in the content are accurate at the time of publication. If the content was published on Instagram six months ago and a clinical guideline has since changed, the caption must be updated or the content must not be published on the website.

**Appropriate for the patient audience:** The content does not use imagery, language, or clinical detail that would be alarming or inappropriate for a general patient audience, including anxious patients and family members.

**Permanence:** The content is stable — it is not tied to a time-limited event, a seasonal reference, or a trending social media topic that will make it meaningless in three months.

## 4.3 What Should Not Be Published

| Content type | Reason |
|-------------|--------|
| Purely promotional posts | Media Hub is educational, not marketing |
| Holiday/seasonal greetings | Time-limited; irrelevant to patient needs |
| Platform-native engagement prompts ("Like and share if...") | Format incompatible with website register |
| Content referencing a specific news event or current situation | Will date poorly; may be misinterpreted out of context |
| Content that includes informal or overly casual language that cannot be cleanly separated from the educational content | Register mismatch |
| Content featuring patients (even with consent given on social media) | Patient consent for website display must be separately confirmed; social platform consent does not transfer |
| Behind-the-scenes or personal lifestyle content | Not appropriate for a clinical trust context |
| Platform-specific visual formats (Stories designed for vertical + swipe interaction) | Cannot be reproduced meaningfully on the website |

## 4.4 Caption Editing Principle

The caption that appears on the website for a Media Item is not required to be identical to the caption on the social platform. The administrator may:
- Shorten the caption if it contains platform-native language ("double tap if you agree!")
- Reformat the caption for website readability (removing excessive line breaks, hashtags, emoji strings)
- Add a clarifying sentence if the platform caption assumes context that a website visitor may not have

The administrator may NOT:
- Rewrite the substance of what was communicated — only the format
- Add medical claims or recommendations that were not in the original post
- Change the meaning of any clinical statement

If the platform caption requires such extensive editing that the website version would effectively be a different piece of content, the administrator should create a new SN Article rather than publishing the Media Item as-edited.

## 4.5 Recency and Archiving

The Media Hub displays the 12 most recently approved Media Items on the /sfatul-neurochirurgului hub page. Older items remain in the WordPress Media Item CPT as published entries and are accessible via the full Media Hub archive (Phase 2 sub-page at /sfatul-neurochirurgului/media, or Load More pattern in Phase 1).

Content does not expire automatically. The administrator reviews the Media Hub periodically (quarterly in Phase 1) and unpublishes entries that:
- Contain medical information that has been superseded by updated guidelines
- Reference a specific location, service, or situation that no longer applies
- Are significantly older than the majority of current content (creating a misleading impression of recent activity)

---

# 5. Manual Workflow — Phase 1

## 5.1 Overview

In Phase 1, all Media Hub curation is performed manually by the administrator. There is no automation. The administrator monitors the social channels, identifies content worth featuring, and creates Media Item CPT entries directly in WordPress.

## 5.2 Step-by-Step Phase 1 Process

```
Administrator monitors social channels
  (YouTube channel, Instagram Business account, Facebook Page)
  Frequency: determined by Dr. Ungureanu + admin — weekly is typical
          ↓
Administrator identifies a post worth featuring in the Media Hub
          ↓
Administrator creates a new Media Item CPT entry in WordPress admin:
  · title: [content title or first 60 characters of caption]
  · source_platform: YouTube / Instagram / Facebook
  · source_url: [permanent URL to the original post]
  · caption: [caption text — edited for website register if needed]
  · thumbnail: [image uploaded to WordPress media library — not a URL to the platform]
  · platform_indicator: [YouTube / Instagram / Facebook icon — set by dropdown field]
  · media_type: video / image / carousel / text
  · is_featured_video: [true only if this YouTube video should also appear in Section 4 Videoclipuri]
  · display_order: [integer; lower = earlier in Videoclipuri section if is_featured_video]
  · post_date_original: [the date the post was published on the social platform]
  · status: publish (administrator can publish directly in Phase 1 — no automated draft step)
          ↓
Entry appears in Media Hub section on /sfatul-neurochirurgului
```

**Thumbnail upload requirement:** The thumbnail must be uploaded to the WordPress media library — it must not be a URL pointing to the social platform's CDN. Hot-linking from Instagram, YouTube, or Facebook CDN would:
- Create a third-party connection when the Media Hub section loads (GDPR/performance issue)
- Break when the platform regenerates or deletes CDN URLs
- Give the platform a signal that their content is being displayed elsewhere (API terms consideration)

**Thumbnail dimensions:**
- YouTube: download the `maxres` thumbnail if available (1280×720px), otherwise `high` (480×360px). The website stores this at a reasonable quality — 1280×720px is stored; display size is determined by the CSS grid.
- Instagram: download the original image at maximum available resolution
- Facebook: download the `full` size image from the attachment data

## 5.3 Phase 1 Curation Frequency

**Recommended:** Administrator reviews social channels weekly or at the cadence agreed with Dr. Ungureanu. Not every post needs to become a Media Item — the goal is quality curation, not completeness.

**No backfill obligation:** Phase 1 does not require or expect the administrator to retroactively add all existing social content to the Media Hub. A curated selection of recent, high-quality content is sufficient for launch.

## 5.4 Phase 1 Media Item Lifecycle

| Event | Administrator action |
|-------|---------------------|
| New social post identified as Media Hub-worthy | Create new Media Item CPT entry, publish |
| Existing Media Item becomes outdated | Set status → draft (hides from Media Hub without deleting) |
| Existing Media Item has medical content that is now inaccurate | Unpublish immediately → update caption if the underlying media is still valid → republish, OR delete permanently |
| Original social post is deleted by Dr. Ungureanu | Administrator manually unpublishes or deletes the corresponding Media Item CPT entry (no automation — this must be a deliberate admin action) |
| Dr. Ungureanu edits the caption on the original social post | Administrator manually reviews whether the WordPress entry needs updating (no automation) |

---

# 6. Make.com Automation Workflow — Phase 2

## 6.1 Overview

Phase 2 introduces Make.com (make.com) as an intermediary between the social platforms and WordPress. Make monitors each social channel for new content and creates WordPress Draft entries automatically. The administrator reviews and publishes (or discards) each draft. No content is ever published automatically.

The primary benefit is reduced manual monitoring burden — the administrator no longer needs to check each social channel for new content. Make delivers new content to the WordPress draft queue; the administrator processes the queue at their convenience.

## 6.2 Architecture

```
Make.com Account
  └── Scenario 1: YouTube → WordPress
  └── Scenario 2: Instagram → WordPress
  └── Scenario 3: Facebook → WordPress

WordPress
  └── Media Item CPT (receives Draft entries from Make)
  └── Application Password (authenticates Make → WordPress REST API)

Social platforms (read-only access for Make)
  └── YouTube Data API v3 (OAuth2)
  └── Instagram Graph API (Page Access Token)
  └── Facebook Graph API (Page Access Token)
```

**WordPress REST API endpoint for Media Item creation:**
`POST /wp-json/wp/v2/[media-item-cpt-rest-slug]`

The REST API slug for the Media Item CPT is defined during Phase 3 implementation. It must be registered with `show_in_rest: true` in the CPT registration function. Authentication uses a WordPress Application Password (Settings → Users → [Admin User] → Application Passwords), generated specifically for Make.com and stored in Make's connection settings.

## 6.3 Scenario 1 — YouTube → WordPress

**Trigger:** Make polls the YouTube channel every 15 minutes for new videos
*(YouTube does not support webhooks — polling is the only option)*

**Make modules in sequence:**
```
[1] YouTube — Watch Videos (module: Search/List Videos, channel: [Dr. Ungureanu's channel ID])
    Polls: every 15 minutes
    Filter: only videos published since last successful poll timestamp
          ↓
[2] YouTube — Get a Video (module: Get a Video, video ID from step 1)
    Retrieves: title, description, publishedAt, thumbnail URLs, duration
          ↓
[3] HTTP — Download thumbnail
    URL: snippet.thumbnails.maxres.url (fallback: snippet.thumbnails.high.url)
    Stores: binary image data
          ↓
[4] WordPress — Upload Media (module: Upload a Media)
    Uploads: binary thumbnail from step 3 to WordPress media library
    Returns: WordPress attachment ID
          ↓
[5] WordPress — Create a Post (module: Create a Post)
    CPT: media-items (or whatever the REST slug is)
    Fields:
      title: {{snippet.title}}
      content: {{snippet.description | truncate: 500}}
      status: draft
      meta[source_platform]: youtube
      meta[source_url]: https://www.youtube.com/watch?v={{id.videoId}}
      meta[post_date_original]: {{snippet.publishedAt}}
      meta[platform_indicator]: youtube
      meta[media_type]: video
      meta[is_featured_video]: false (default; admin sets to true if appropriate)
      featured_media: {{WordPress attachment ID from step 4}}
          ↓
[6] Email — Send a notification
    To: [admin email — Q16]
    Subject: "YouTube nou — așteptare revizuire: {{snippet.title}}"
    Body: Video title, description excerpt, thumbnail preview link, direct link to WordPress draft
```

**Error handling in Scenario 1:**
- If step 3 (thumbnail download) fails: continue without thumbnail; note absence in notification email; admin must add thumbnail manually
- If step 5 (WordPress post creation) fails: log error in Make execution history; send error notification email to admin; do NOT retry automatically (retry could create duplicate drafts)
- If the YouTube API returns an error: log in Make execution history; send error notification email

## 6.4 Scenario 2 — Instagram → WordPress

**Trigger:** Make webhook or 15-minute polling for new Instagram Business Account media
*(Instagram Graph API supports webhooks with appropriate app configuration; polling is the alternative)*

**Make modules in sequence:**
```
[1] Instagram for Business — Watch Media (or HTTP — Get Instagram Media)
    Monitors: Dr. Ungureanu's Instagram Business Account
    Retrieves: new media objects (IMAGE, VIDEO, CAROUSEL_ALBUM, REEL)
    Excludes: STORY type
          ↓
[2] Instagram for Business — Get a Media
    Retrieves: media_type, media_url (temporary), thumbnail_url (for VIDEO/REEL),
               caption, timestamp, permalink
          ↓
[3] HTTP — Download thumbnail/image
    For IMAGE and CAROUSEL_ALBUM: download media_url immediately (URL expires)
    For VIDEO and REEL: download thumbnail_url
    Stores: binary image data
          ↓
[4] WordPress — Upload Media
    Uploads: binary image to WordPress media library
    Returns: WordPress attachment ID
          ↓
[5] WordPress — Create a Post
    CPT: media-items
    Fields:
      title: {{caption | slice: 0, 60}} (first 60 characters of caption)
      content: {{caption}}
      status: draft
      meta[source_platform]: instagram
      meta[source_url]: {{permalink}}
      meta[post_date_original]: {{timestamp}}
      meta[platform_indicator]: instagram
      meta[media_type]: {{media_type | downcase}}
      meta[is_featured_video]: false
      featured_media: {{WordPress attachment ID from step 4}}
          ↓
[6] Email — Send notification
    Subject: "Instagram nou — așteptare revizuire: {{caption | slice: 0, 60}}"
    Body: Caption, media type, thumbnail, link to Instagram post, link to WordPress draft
```

**Instagram-specific considerations:**
- The `media_url` returned by Instagram Graph API is temporary — Step 3 must execute within the same Make scenario run, immediately after Step 2. Do not store the media_url and attempt to download later.
- If the caption is empty (image post with no caption text): use the media type as the title ("Instagram VIDEO — [date]") and leave content empty. Admin must add caption context during review.
- Carousel albums: only the first image in the carousel is downloaded as the thumbnail. The full carousel is accessible via the permalink.

## 6.5 Scenario 3 — Facebook → WordPress

**Trigger:** Make webhook (Facebook Page webhook subscription to `feed` topic) or 15-minute polling

**Make modules in sequence:**
```
[1] Facebook Pages — Watch Posts (or webhook trigger)
    Monitors: Dr. Ungureanu's Facebook Business Page
    Retrieves: new page posts (status, photo, video, link)
    Excludes: ads, shared posts from other pages, event posts
          ↓
[2] Facebook Pages — Get a Post
    Retrieves: message, created_time, permalink_url, attachments
          ↓
[3] HTTP — Download attachment image
    If attachments.data contains an image: download the image URL
    If no image: use the Facebook platform icon as the thumbnail (stored in WordPress media library)
    Stores: binary image data (or skips if no image)
          ↓
[4] WordPress — Upload Media (conditional — skip if no image)
    Uploads: binary image to WordPress media library
    Returns: WordPress attachment ID (or null)
          ↓
[5] WordPress — Create a Post
    CPT: media-items
    Fields:
      title: {{message | slice: 0, 60}} (or "Facebook post — [date]" if no message)
      content: {{message}}
      status: draft
      meta[source_platform]: facebook
      meta[source_url]: {{permalink_url}}
      meta[post_date_original]: {{created_time}}
      meta[platform_indicator]: facebook
      meta[media_type]: [derived from attachments.data type]
      meta[is_featured_video]: false
      featured_media: {{WordPress attachment ID if available, else blank}}
          ↓
[6] Email — Send notification
    Subject: "Facebook nou — așteptare revizuire: {{message | slice: 0, 60}}"
    Body: Post message excerpt, attachment info, link to Facebook post, link to WordPress draft
```

**Facebook-specific considerations:**
- Facebook posts can have a `story` field (auto-generated text like "Dr. X updated his status") that is NOT the post content. The `message` field is the correct content field — never use `story`.
- Link posts (external URL shares): the `message` field contains what Dr. Ungureanu wrote; the `attachments` field contains the external link metadata. If the post is purely a link share with no accompanying text, it may not be appropriate for the Media Hub — the administrator decides during review.
- Facebook video posts: if a video was also published to YouTube, the administrator may prefer to create a single Media Item pointing to the YouTube URL rather than creating two separate entries. This is an editorial decision made at review time.

## 6.6 Make.com Plan Requirements

Make.com's automation features are tiered by plan. Phase 2 requires:
- At minimum: **Make Core plan** (or equivalent at time of Phase 2 implementation)
- Operations budget: 3 platforms × polling/webhook scenario × average posts per month. A practice posting 10–20 items per month across all platforms uses approximately 300–600 operations per month after accounting for multi-step scenarios (each step in a scenario = 1 operation). This is within Core plan limits.
- Connections: 3 social platform connections (YouTube, Instagram/Facebook Graph API, Facebook Pages) + 1 WordPress REST API connection

**Note:** Make.com pricing and plan structures change. Verify current plan requirements at time of Phase 2 implementation.

---

# 7. Draft Approval Process

## 7.1 The Review Queue

In Phase 2, the administrator's primary Media Hub task is reviewing the WordPress draft queue rather than manually monitoring social channels. Drafts arrive from Make.com after each new social platform publication. The administrator does not need to act on each draft immediately — they process the queue at a cadence agreed with Dr. Ungureanu.

**Recommended review cadence:** Daily or every 2 days. A draft that sits unreviewed for more than a week represents a publication delay that undermines the value of the automation.

## 7.2 What the Administrator Reviews

For each Draft entry in the Media Item CPT queue, the administrator verifies:

| Check | What to look for | Action if failing |
|-------|-----------------|-------------------|
| **Content appropriateness** | Does this content meet the editorial principles in Section 4? | Discard draft |
| **Thumbnail quality** | Did the thumbnail download successfully? Is it the right image? | If missing: upload manually. If wrong: upload correct image. |
| **Caption accuracy** | Is the imported caption complete? Is it in the right register for the website? | Edit caption as needed per Section 4.4 principles |
| **Source URL** | Does the permalink link to the correct original post? | Correct if wrong |
| **Platform indicator** | Is the platform (YouTube / Instagram / Facebook) set correctly? | Correct if wrong |
| **Medical accuracy** | Does the content contain any clinical claim that may be outdated? | If inaccurate: update caption or discard; do not publish inaccurate medical content |
| **Featured video assignment** | Should this YouTube video also appear in Section 4 (Videoclipuri)? | Set `is_featured_video: true` and assign `display_order` if appropriate |
| **Duplicate check** | Is this the same content as an existing published Media Item (e.g., YouTube video already exists as a Facebook reposts)? | If duplicate: discard draft; the existing entry is sufficient |

## 7.3 Approval Decision

After the review, the administrator makes one of three decisions:

**Publish:** Set status → publish. The entry appears immediately in the Media Hub on /sfatul-neurochirurgului.

**Discard (trash):** The content does not meet editorial standards, is a duplicate, or is not appropriate for the website. Move to WordPress trash. No patient-facing consequence.

**Revise and defer:** The content has value but the caption needs substantial editing, the thumbnail is wrong, or clarification from Dr. Ungureanu is needed. Leave in draft status; add an admin note; return later. This state should be temporary — a draft left in perpetual "pending revision" limbo should be discarded rather than accumulating.

## 7.4 No Partial Publication

Every field of the Media Item CPT entry must be complete before publication:
- Title: populated
- Caption: populated (edited if needed)
- Thumbnail: uploaded to WordPress media library (not a URL)
- Source platform: set
- Source URL: populated and verified
- Post date original: populated

A Media Item published with missing fields creates a broken display in the Media Hub. The administrator confirms all fields are populated before setting status → publish.

---

# 8. Content Governance

## 8.1 Ownership and Responsibility

**Content owner:** Dr. George Ungureanu — all content in the Media Hub originates from his official social media channels. He is responsible for the accuracy of the source content.

**Curation responsibility:** The administrator — responsible for the editorial selection, the accuracy of imported metadata, the quality of the website display, and the maintenance of published entries over time.

**Clinical accuracy responsibility:** Dr. Ungureanu — if any clinical claim in a published Media Item is identified as outdated or inaccurate, Dr. Ungureanu determines whether the entry should be updated, unpublished, or remains acceptable.

## 8.2 Routine Maintenance

**Quarterly review:** The administrator reviews all published Media Items quarterly:
- Are all thumbnails loading correctly?
- Are all source URLs still valid (social posts may be deleted by the author)?
- Is any content clinically outdated?
- Is the Media Hub's 12-most-recent selection still the best representation of the content library?

**Annual review:** Dr. Ungureanu and the administrator review the full Media Item library together:
- Is the balance of platforms (YouTube / Instagram / Facebook) appropriate?
- Are there content categories (condition types, educational topics) that are over- or under-represented?
- Is the Phase 2 automation working correctly, or have API changes caused any silent failures?

## 8.3 Unpublishing Published Content

When a published Media Item must be removed:
1. Administrator sets the CPT entry status → draft (or trash if permanent removal is preferred)
2. The entry disappears from the Media Hub immediately on the next page load (no cache clearing required if WordPress is not served with an aggressive full-page cache)
3. If the entry was removed because the source social post was deleted: the draft/trash action is final — do not republish
4. If the entry was removed because of a medical accuracy issue: the administrator notes the reason in an admin-only note field and informs Dr. Ungureanu

**Urgency levels for removal:**
- Medical inaccuracy: remove within 24 hours of identification
- Broken thumbnail or link: remove or repair within 48 hours
- Outdated content (not inaccurate, just stale): remove within 7 days of quarterly review

## 8.4 Social Platform Post Deletion

If Dr. Ungureanu deletes a post from Instagram, YouTube, or Facebook after the corresponding Media Item has been published on the website:
- The Media Item CPT entry remains published on the website — there is no automatic detection of source post deletion
- The source URL (permalink) in the CPT entry becomes a dead link
- The administrator must manually unpublish or update the entry when they next run the quarterly review, or when they notice the source post is gone
- If the content itself is still valid (the information is accurate and relevant) but the source URL is dead, the administrator may: keep the entry with the source URL updated to a YouTube channel page or a general SN page, rather than unpublishing it entirely

**Phase 2 opportunity:** A Make scenario that periodically checks whether the source URLs in published Media Item CPT entries are still valid (returning a 200 HTTP response) would automate detection of deleted social posts. This is documented here as a Phase 2 enhancement, not a Phase 1 or Phase 2 launch requirement.

## 8.5 Content from Unofficial or Personal Accounts

The automation scenarios and the manual curation process monitor ONLY the official Sfatul Neurochirurgului accounts:
- The specific YouTube channel URL confirmed by Dr. Ungureanu (Q25)
- The specific Instagram Business Account confirmed by Dr. Ungureanu (Q25)
- The specific Facebook Business Page confirmed by Dr. Ungureanu (Q25)

Content from Dr. Ungureanu's personal social accounts, from related accounts not designated as official Sfatul Neurochirurgului channels, or from third-party accounts that reference Dr. Ungureanu is NOT captured by the automation and is NOT manually added to the Media Hub without explicit approval.

---

# 9. Security and Privacy Considerations

## 9.1 Credential Storage and Management

**Make.com connections:** All API credentials — OAuth 2.0 tokens, Page Access Tokens, Application Passwords — are stored exclusively within Make.com's encrypted connection settings. They are not stored in:
- This document or any document in the `docs/` directory
- The WordPress database in an accessible field
- Any file in the website repository
- Any email, chat message, or shared document

**WordPress Application Password:** A dedicated Application Password (Settings → Users → [admin user] → Application Passwords) is created specifically for Make.com. This password is used only by Make.com. It is stored in Make.com and nowhere else. If the Make.com account is compromised or the integration is terminated, this Application Password is revoked immediately in WordPress — the main admin account password is not affected.

**Token lifecycle:**
| Platform | Token type | Expiry | Renewal process |
|----------|-----------|--------|----------------|
| YouTube | OAuth 2.0 refresh token | Does not expire (until revoked) | Renew access token automatically using refresh token; Make.com handles this |
| Instagram Graph API | Long-lived User Access Token | 60 days | Must be manually refreshed before expiry. Make.com sends a warning if the token is about to expire. The administrator renews the token in the Facebook/Instagram developer settings and updates the Make connection. |
| Facebook Graph API | Page Access Token | Does not expire (if generated correctly from a long-lived user token) | Verify at Phase 2 setup; monitor for unexpected expiry |
| WordPress REST API | Application Password | Does not expire (until revoked) | No renewal needed; revoke and regenerate if compromised |

**Instagram token expiry is a critical maintenance risk.** If the Instagram long-lived token expires without renewal, the Instagram scenario fails silently — no new Instagram content will be processed until the token is renewed and the Make connection is updated. The administrator should calendar the token renewal 1 week before the 60-day expiry.

## 9.2 API Permissions — Principle of Least Privilege

Each platform API connection requests only the permissions necessary for reading content:

| Platform | Permissions requested | Permissions NOT requested |
|----------|----------------------|--------------------------|
| YouTube Data API v3 | `youtube.readonly` (read channel content) | Write permissions, upload, delete, analytics |
| Instagram Graph API | `instagram_basic`, `instagram_manage_media`, `pages_read_engagement` | DMs, comments, follower management, ads |
| Facebook Graph API | `pages_read_engagement`, `pages_read_user_content` | Post creation, comment management, ads, insights |
| WordPress REST API | Create post, upload media (application password scope) | User management, plugin management, site settings |

## 9.3 GDPR Considerations

**Thumbnail storage:** All thumbnails are downloaded and stored in the WordPress media library. The website does not serve images directly from Instagram CDN, YouTube CDN, or Facebook CDN. This means no third-party connection is made when a patient views the Media Hub — no tracking pixel fires, no CDN cookie is set.

**Source URL links:** The "View on [Platform]" links in Media Hub cards are external links that open the social platform in a new browser tab. When a patient follows these links, they are subject to that platform's own tracking and privacy policy. The georgeungureanu.doctor privacy policy (`/politica-de-confidentialitate`) discloses that external links lead to third-party platforms with their own privacy policies.

**Patient data:** The Media Hub does not collect any patient data. There are no analytics pixels, no event tracking on Media Hub card clicks, no user identification. The administrator's browsing of the WordPress admin panel is subject to standard WordPress logging.

**Make.com data handling:** Make.com processes API response data (social post content, thumbnail URLs) and transmits it to WordPress. This data is Dr. Ungureanu's own published content — not patient data. Make.com's own privacy policy and data processing terms apply to the Make account.

## 9.4 Access Control

**Who can create/edit/publish Media Items:**
- WordPress Administrator role — full access
- WordPress Editor role — may be granted access if a dedicated editor is appointed

**Who cannot:**
- No public submission path exists for the Media Item CPT
- No guest user, subscriber, or contributor role has Media Item write access
- The Make.com Application Password grants create access only — it cannot edit, unpublish, or delete Media Items

**Make.com account security:**
- The Make.com account should have 2-factor authentication enabled
- Access to the Make.com account is limited to the administrator (and Dr. Ungureanu if he requires visibility)
- If the Make.com account must be shared, use Make.com's team member invitation feature rather than sharing account credentials

## 9.5 Malicious Content Risk

**Scenario:** Dr. Ungureanu's Instagram or Facebook account is compromised. An attacker posts malicious content on the account. Make.com detects the new post and creates a WordPress Draft.

**Mitigation:** The Draft review step is the only protection. The administrator must recognize that the content is not from Dr. Ungureanu (unusual content, unusual tone, unusual subject matter) and discard the draft. They must also alert Dr. Ungureanu immediately so he can secure the social account.

**Consequence if the review step is bypassed:** Malicious content would appear on the website. This is why bypassing the review step — publishing Make-created drafts automatically — is categorically prohibited.

**Early warning:** If the administrator receives a Make notification for a post that seems inconsistent with Dr. Ungureanu's usual content, they should immediately check the social account directly before reviewing the draft. If the account is compromised, they should notify Dr. Ungureanu before taking any action on the draft.

---

# 10. Accessibility Requirements

## 10.1 Media Hub Display Accessibility

The Media Hub section on /sfatul-neurochirurgului must meet WCAG 2.1 AA as a minimum, with the following specific requirements:

**Image alt text:**
All thumbnails in the Media Hub have descriptive alt text. The alt text is entered by the administrator during the Media Item entry creation or review. It is not generated automatically.

Alt text format:
- YouTube: `"[Video title] — videoclip YouTube, [duration if known]"`
- Instagram: `"[Brief description of image content] — postare Instagram, [post date month and year]"`
- Facebook: `"[Brief description of image or post content] — postare Facebook, [post date month and year]"`

Alt text must not be empty. If the administrator does not provide alt text, the Media Item entry is not published until alt text is added.

**External links:**
All "View on [Platform]" links include:
- `target="_blank"` (opens in new tab)
- `rel="noopener noreferrer"` (security + no referrer)
- A screen-reader-only text suffix: `, se deschide în filă nouă` — so screen reader users hear "Vizualizați pe YouTube, se deschide în filă nouă" rather than just "Vizualizați pe YouTube"

**Platform icon:**
The platform indicator icon (YouTube, Instagram, Facebook) overlaid on the thumbnail is `aria-hidden="true"` — the information is conveyed by the link text and alt text, not by the icon.

**No autoplay:**
No video content in the Media Hub autoplays. YouTube thumbnails displayed as Media Items link to the YouTube URL — they do not embed the YouTube player. If a YouTube embed is used (Phase 3 decision for Section 4 Videoclipuri), the embed uses `?autoplay=0` and plays only on user interaction.

**Keyboard navigation:**
Each Media Hub card is keyboard-accessible. The entire card or a designated "View on [Platform]" link within each card is the Tab stop. Tab moves through all 12 cards. Enter activates the link (opens in new tab).

## 10.2 Color Contrast in Media Hub Cards

Platform indicator icons and caption text must meet WCAG 2.1 AA contrast ratios:
- Caption text (`type-body` `color-ink` on `color-surface`): 14.5:1 — passes AAA
- Platform icon on thumbnail: the icon has a semi-transparent dark background pill (`color-ink` at 70% opacity) — the icon itself is `color-surface` white. Contrast between `color-surface` and `color-ink` at 70% opacity exceeds 4.5:1 — confirmed during Phase 3 build.

## 10.3 Reduced Motion

Media Hub cards may have a hover state (subtle shadow elevation or background change). Under `prefers-reduced-motion: reduce`, no transform or transition animation is applied — the hover state changes are immediate (color change only, no movement).

## 10.4 Cognitive Accessibility

- All 12 Media Hub cards follow the same visual format: thumbnail → platform indicator → caption → view link. Consistent format reduces cognitive load.
- Caption text is truncated at 2 lines using CSS `line-clamp`. The truncated text is accessible — the full content is available at the source URL. The `line-clamp` truncation does not use `aria-label` to hide content — the truncation is visual; the DOM contains the full text (this is the correct implementation).
- No Media Hub content is interactive beyond the external link. There are no expand/collapse mechanisms, no modals, no lightboxes in Phase 1.

---

# 11. Failure Scenarios

## 11.1 Make Scenario Fails to Execute

**Symptoms:** No notification email for a new social post that the administrator knows was published; draft not created in WordPress; Make execution history shows error.

**Causes and responses:**

| Cause | Response |
|-------|---------|
| Make account over operation limit for the billing period | Upgrade Make plan or reduce scenario polling frequency |
| WordPress REST API returned error (5xx) | WordPress may have been temporarily unavailable; the draft was not created; add the entry manually using Phase 1 workflow |
| WordPress REST API authentication failed | The Application Password may have been revoked or expired; regenerate Application Password in WordPress and update Make connection |
| Platform API rate limit hit | Rate limit resets on a rolling window; scenario will succeed on next execution; no action needed unless rate limit is hit consistently |
| Make scenario itself has a module error | Check Make execution history for the specific error; adjust the scenario mapping if the platform API response format has changed |

**Recovery for missed drafts:** When Make fails to create a draft for a specific post, the administrator creates the Media Item entry manually using the Phase 1 workflow. The automated draft step is not retried for posts that were missed due to scenario failure — manual entry is the correct fallback.

## 11.2 Platform API Changes

**Instagram Graph API** has undergone breaking changes multiple times in its history, including the complete deprecation of Instagram Basic Display API in 2024. The Make.com Instagram modules may cease working if Meta changes the API structure or permissions.

**Facebook Graph API** similarly undergoes regular changes, with endpoint deprecations and permission model changes announced in quarterly API changelogs.

**YouTube Data API v3** is more stable but has had quota changes and feature deprecations.

**Response to API breakage:**
1. Make scenarios stop creating drafts (the administrator notices the absence of notification emails)
2. Administrator checks Make execution history for error messages indicating API changes
3. If Make has released an updated module for the platform: update the scenario to use the new module
4. If no updated module is available: switch to Phase 1 manual workflow for that platform while Make support is contacted or an alternative is developed
5. Dr. Ungureanu is notified that automation for that platform is temporarily suspended

**Design principle:** The website and the Media Hub must function without Make.com automation. Phase 1 (manual workflow) is always the fallback. The automation is a convenience, not a dependency.

## 11.3 Social Account Credentials Expire

**Instagram token expiry:** The most likely and most regularly occurring failure. If the long-lived token expires:
- The Instagram scenario fails silently from that point forward
- No Instagram drafts are created
- The administrator may not notice immediately unless they are monitoring Make execution history or expecting a notification that did not arrive

**Prevention:** Calendar the Instagram token renewal 7 days before the 60-day expiry. Make.com sends a connection health notification if a connection fails — ensure Make notification emails are not filtered to spam.

**Response:** Generate a new long-lived token in the Facebook/Instagram developer console; update the Make Instagram connection; run a test scenario execution to confirm restoration.

## 11.4 Thumbnail Download Fails

**Cause:** The platform CDN URL for the image or thumbnail is expired, unavailable, or blocked at the time Make executes the download step.

**Response:** Make creates the draft with the thumbnail field blank. The notification email notes that the thumbnail download failed. The administrator must upload the correct thumbnail manually before publishing the entry.

**For Instagram specifically:** The `media_url` from Instagram Graph API expires within hours. If the Make scenario does not execute promptly after the post is published (e.g., Make has an outage), the media_url may be expired before Make can download it. The administrator must retrieve the image directly from Instagram and upload it manually.

## 11.5 Duplicate Draft Creation

**Cause:** Make's duplicate detection fails or the scenario is run manually during testing. The same social post creates two draft entries in WordPress.

**Response:** The administrator identifies the duplicate during the review queue process (both drafts have the same source URL). The administrator discards one draft and processes the other normally.

**Prevention:** The Make scenario should include a duplicate check step: before creating a new CPT entry, query WordPress for an existing entry with the same `source_url` meta field. If found, do not create a second entry. This duplicate-check step is included in the Phase 2 implementation brief.

## 11.6 WordPress Is Down When Make Runs

**Cause:** WordPress is unavailable (maintenance, hosting outage, plugin conflict) at the moment Make attempts to create the draft.

**Response:** Make retries failed steps according to its retry settings (configurable per scenario — recommended: 3 retries with 5-minute intervals). If all retries fail: Make logs the error in execution history and sends an error notification email. The administrator manually creates the Media Item entry using Phase 1 workflow.

**Note:** Do not configure Make to retry more than 3–5 times for WordPress draft creation. Aggressive retrying could create multiple drafts when WordPress comes back online. Set retry intervals wide enough that WordPress recovery is likely between retries.

---

# 12. Launch Requirements

## 12.1 Phase 1 Launch Requirements

Phase 1 (manual curation) can launch as soon as:

| Requirement | Source | Status |
|-------------|--------|--------|
| Media Item CPT registered in WordPress | Phase 3 implementation | Required |
| ≥3 Media Item CPT entries created and published | Administrator manual entry | Required — Section 10 visibility gate |
| Thumbnails uploaded to WordPress media library (not hot-linked) | Administrator | Required |
| Alt text populated for all thumbnails | Administrator | Required |
| Source URLs verified (all permalinks return 200) | Administrator | Required |
| Platform indicators set correctly for all entries | Administrator | Required |
| Section 10 visibility condition active (≥3 entries gate) | Phase 3 implementation | Required |

**Phase 1 launch does not require:**
- Make.com account
- API credentials for any platform
- Any specific minimum of entries beyond 3

## 12.2 Phase 2 Launch Requirements

Phase 2 (Make.com automation) requires, in addition to Phase 1 infrastructure:

| Requirement | Source | Status |
|-------------|--------|--------|
| Q25 — YouTube channel ID confirmed | Dr. Ungureanu | Blocking |
| Q25 — Instagram Business Account confirmed | Dr. Ungureanu | Blocking for Instagram scenario |
| Q25 — Facebook Business Page confirmed | Dr. Ungureanu | Blocking for Facebook scenario |
| YouTube Data API v3 access configured | Administrator + Dr. Ungureanu | Blocking for YouTube scenario |
| Instagram Graph API access configured | Administrator + Dr. Ungureanu | Blocking for Instagram scenario |
| Facebook Graph API access configured | Administrator + Dr. Ungureanu | Blocking for Facebook scenario |
| Make.com account active (Core plan or equivalent) | Practice | Blocking |
| WordPress Application Password created for Make | Administrator | Blocking |
| Media Item CPT REST API enabled (`show_in_rest: true`) | Phase 3 implementation | Blocking |
| Duplicate check step implemented in all three scenarios | Phase 2 Make build | Blocking |
| Error notification email configured in all three scenarios | Phase 2 Make build | Blocking |
| Instagram token renewal calendar reminder set | Administrator | Required for ongoing operation |
| All three scenarios tested with real content before go-live | Administrator | Required |

## 12.3 Content Volume at Launch

**Minimum for Media Hub to be visible on /sfatul-neurochirurgului:** 3 published Media Item CPT entries.

**Recommended for a meaningful Media Hub at launch:** 6–12 published Media Item CPT entries, spanning at least 2 platforms, representing a range of educational content types.

**No backfill requirement:** The practice does not need to retroactively add all historical social content before launch. A curated selection of recent, high-quality content from across the platforms is sufficient.

---

# 13. Blocking Dependencies

## 13.1 Full Dependency Table

| Dependency ID | Dependency | Source | Impact if Missing | Phase 1 blocker? | Phase 2 blocker? |
|--------------|-----------|--------|------------------|-----------------|-----------------|
| Q25a | YouTube channel URL / channel ID | Dr. Ungureanu | Phase 2 YouTube scenario cannot be configured; Phase 1 YouTube Media Items must be linked manually | No | YES |
| Q25b | Instagram Business Account URL / account ID | Dr. Ungureanu | Phase 2 Instagram scenario cannot be configured | No | YES |
| Q25c | Facebook Business Page URL / page ID | Dr. Ungureanu | Phase 2 Facebook scenario cannot be configured | No | YES |
| Q25d | Confirmation that all three accounts are official Sfatul Neurochirurgului accounts (not personal accounts) | Dr. Ungureanu | Automation would monitor wrong accounts | No | YES |
| Q25e | Initial content for manual Media Hub curation (≥3 items) | Administrator (using existing social posts) | Phase 1 Media Hub section remains hidden | YES | N/A |
| — | Media Item CPT registered in WordPress | Phase 3 implementation | No entries can be created | YES | YES |
| — | Media Item CPT `show_in_rest: true` | Phase 3 implementation | Make cannot create entries via REST API | No | YES |
| — | WordPress Application Password for Make | Administrator | Make cannot authenticate to WordPress | No | YES |
| — | Make.com account and plan | Practice | Phase 2 automation impossible | No | YES |
| — | YouTube Data API v3 OAuth credentials | Administrator | YouTube scenario fails | No | YES for YouTube |
| — | Instagram Graph API credentials + long-lived token | Administrator | Instagram scenario fails | No | YES for Instagram |
| — | Facebook Graph API Page Access Token | Administrator | Facebook scenario fails | No | YES for Facebook |
| — | Instagram token renewal process documented and calendared | Administrator | Instagram automation fails silently after 60 days | No | YES |
| — | Duplicate check step in Make scenarios | Phase 2 build | Duplicate drafts created | No | YES |
| — | Error notification email configured in all scenarios | Phase 2 build | Silent failures go unnoticed | No | YES |
| Q16 | Admin notification email address | Dr. Ungureanu | Draft notification emails have no destination | No | YES |
| — | Alt text workflow for thumbnails | Administrator process | WCAG accessibility fails | YES | YES |

## 13.2 Post-Launch Enhancements (not launch blockers)

| Enhancement | When |
|-------------|------|
| Source URL validity checker (Make scenario monitoring dead links) | Phase 2+, after Media Hub library exceeds 20 entries |
| Instagram token auto-renewal via Make | Phase 2+, research Make.com Instagram token refresh capabilities |
| Media Hub archive sub-page (/sfatul-neurochirurgului/media) | Phase 2, when Media Items exceed 24 |
| Category/topic tagging for Media Items | Phase 2, enables filtering |
| Facebook post type classification (auto-detect video vs. image vs. text) | Phase 2 Make scenario enhancement |

---

# 14. Validation Checklist

## 14.1 Phase 1 — Manual Curation Readiness

- [ ] Media Item CPT is registered and accessible in WordPress admin
- [ ] All required CPT fields are present: title, caption, source_platform, source_url, post_date_original, platform_indicator, media_type, is_featured_video, display_order
- [ ] At least 3 Media Item entries are published
- [ ] All thumbnails are stored in the WordPress media library (not hot-linked from platform CDN)
- [ ] All thumbnails have descriptive alt text entered by the administrator
- [ ] All source URLs (permalinks) return valid responses when accessed directly
- [ ] Platform indicators are set correctly for all entries
- [ ] Section 10 on /sfatul-neurochirurgului is visible when ≥3 Media Items exist and hidden when fewer than 3
- [ ] No live social feeds, embedded timelines, or social widgets appear on the site

## 14.2 Editorial Standards

- [ ] Every published Media Item passes the editorial criteria in Section 4.2 (educational value, register consistency, medical accuracy, patient-appropriate, permanence)
- [ ] No published Media Item contains platform-native engagement language ("like and share", "swipe up")
- [ ] No published Media Item contains content from personal accounts (only official Sfatul Neurochirurgului accounts)
- [ ] No social metrics (follower counts, view counts, likes, shares) appear in any Media Hub card
- [ ] Caption editing (where applied) has preserved the substance and meaning of the original post
- [ ] No Medical Hub entry contains clinical content that the administrator has not confirmed is accurate at the time of publication

## 14.3 Phase 2 — Automation Readiness

- [ ] Q25a, Q25b, Q25c all confirmed (YouTube channel, Instagram account, Facebook page URLs)
- [ ] YouTube Data API v3 connection in Make.com is active and tested
- [ ] Instagram Graph API connection in Make.com is active and tested with a valid long-lived token
- [ ] Facebook Graph API connection in Make.com is active and tested
- [ ] WordPress Application Password for Make is created and stored in Make connection settings
- [ ] Media Item CPT has `show_in_rest: true` and the REST API endpoint responds correctly to Make requests
- [ ] All three Make scenarios have been tested with live social posts (not test data)
- [ ] Each scenario creates a WordPress Draft (not a published post) on successful execution
- [ ] Each scenario sends an email notification to the admin email (Q16) on successful execution
- [ ] Each scenario sends an error email notification on failure
- [ ] Duplicate check step is active in all three scenarios
- [ ] Thumbnail download and WordPress media upload is working in all three scenarios
- [ ] Instagram token renewal is calendared 7 days before the 60-day expiry

## 14.4 Security

- [ ] No API credentials, tokens, or passwords appear in any file in the `docs/` directory or the website repository
- [ ] The WordPress Application Password for Make is not the same as the administrator's main account password
- [ ] Make.com account has 2-factor authentication enabled
- [ ] All platform API connections use minimum necessary permissions (read-only where possible)
- [ ] The Make.com account access list is reviewed — only authorized users have access

## 14.5 Accessibility

- [ ] All Media Hub thumbnails have descriptive alt text (not empty, not filename)
- [ ] All external "View on [Platform]" links include screen-reader-only text noting "se deschide în filă nouă"
- [ ] Platform indicator icons are `aria-hidden="true"`
- [ ] No video in the Media Hub autoplays
- [ ] Media Hub cards are keyboard-navigable (Tab → Enter pattern)
- [ ] Color contrast ratios meet WCAG 2.1 AA for all text in Media Hub cards
- [ ] Animations and transitions in Media Hub cards are suppressed under `prefers-reduced-motion`

## 14.6 Privacy and GDPR

- [ ] No third-party JavaScript from Instagram, Facebook, or YouTube is loaded on the website
- [ ] All thumbnails are served from the WordPress media library (not platform CDN)
- [ ] The "View on [Platform]" links in Media Hub cards are plain `<a>` elements (no tracking parameters added)
- [ ] The /politica-de-confidentialitate page mentions that external links lead to third-party platforms with their own privacy policies
- [ ] No patient data is collected or processed through the Media Hub

## 14.7 Failure Resilience

- [ ] The website functions correctly if Make.com is unavailable (Phase 1 manual fallback is documented and the administrator knows the process)
- [ ] The Media Hub section functions correctly with as few as 3 published entries (does not require a minimum above 3)
- [ ] The website does not display broken images or empty cards if a thumbnail fails to load (CSS fallback: platform icon or section background fill)
- [ ] The administrator knows the steps to revoke the WordPress Application Password if the Make.com account is compromised
- [ ] The administrator has documented contact for Make.com support in case of scenario failure that cannot be self-resolved

---

*Media Hub and Automation version: 1.0 — 2026-06-28*
*Source: docs/tasks/09_SFATUL_NEUROCHIRURGULUI.md v1.0, docs/tasks/02_CONTENT_MODELS.md v1.0, docs/tasks/00_PROJECT_ROADMAP.md v1.1*
*Next: docs/tasks/11_AFECTIUNI.md*
