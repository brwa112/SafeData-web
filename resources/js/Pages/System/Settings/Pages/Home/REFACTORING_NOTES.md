# Home Page Components Refactoring

This document outlines the refactoring performed on the Home page settings to improve code organization and maintainability.

## Overview

The large `Index.vue` component has been refactored by extracting individual sections into separate partial components located in the `Partials` folder.

## Created Components

### 1. HeroSection.vue
**Location:** `./Partials/HeroSection.vue`

**Props:**
- `form` (Object, required) - Hero form data
- `selectLanguage` (Object, required) - Selected language object

**Features:**
- Hero title and subtitle management
- Statistics fields (expert tutors, students, experience, campuses)
- Background media selection (image/video)
- Video upload and preview functionality
- Image upload functionality

**Internal Functions:**
- `handleVideoUpload()` - Handles video file selection
- `removeVideo()` - Removes selected video
- `videoPreviewUrl` (computed) - Generates preview URL for videos

### 2. HistorySection.vue
**Location:** `./Partials/HistorySection.vue`

**Props:**
- `form` (Object, required) - History form data
- `selectLanguage` (Object, required) - Selected language object

**Features:**
- History description text area
- Two image upload fields
- Multi-language support for descriptions

### 3. MessageSection.vue
**Location:** `./Partials/MessageSection.vue`

**Props:**
- `form` (Object, required) - Message form data
- `selectLanguage` (Object, required) - Selected language object

**Features:**
- Principal message description
- Principal image upload
- Multi-language support

### 4. MissionSection.vue
**Location:** `./Partials/MissionSection.vue`

**Props:**
- `form` (Object, required) - Mission form data
- `selectLanguage` (Object, required) - Selected language object

**Features:**
- Mission description text area
- Background image upload
- Multi-language support

### 5. SocialSection.vue
**Location:** `./Partials/SocialSection.vue`

**Props:**
- `form` (Object, required) - Social form data

**Features:**
- Social media links (YouTube, Facebook, Instagram, Twitter)
- URL validation and error handling

## Main Index.vue Changes

### Removed Code:
- All section HTML templates (moved to partials)
- Video handling functions (`handleVideoUpload`, `removeVideo`, `videoPreviewUrl`)
- ImageUpload component import (now in partials)

### Added Code:
- Imports for all partial components
- Component usage with proper prop passing

### Maintained Code:
- All form initialization and management
- Branch and language selection logic
- Data synchronization with props
- Save functionality for all sections

## Benefits

1. **Better Code Organization:** Each section is now self-contained with its own logic
2. **Improved Maintainability:** Easier to modify individual sections without affecting others
3. **Enhanced Reusability:** Sections can potentially be reused in other contexts
4. **Cleaner Main Component:** Index.vue is now much cleaner and focused on orchestration
5. **Better Developer Experience:** Easier to navigate and understand specific functionality

## File Structure

```
Pages/System/Settings/Pages/Home/
├── Index.vue                 (Main orchestration component)
└── Partials/
    ├── HeroSection.vue       (Hero section with media handling)
    ├── HistorySection.vue    (History section with images)
    ├── MessageSection.vue    (Principal message section)
    ├── MissionSection.vue    (Mission section)
    └── SocialSection.vue     (Social media links)
```

## Usage

Each partial component maintains its own UI logic while the parent component (`Index.vue`) handles:
- Data management and form state
- API calls and server communication
- Language and branch selection
- Overall page orchestration

The refactoring maintains 100% backward compatibility while significantly improving code structure and maintainability.