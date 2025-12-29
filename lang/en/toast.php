<?php

return [
  'course' => [
    'approved' => 'Course approved successfully',
    'only_pending_can_be_approved' => 'Only pending courses can be approved',
    'rejected_and_notified' => 'Course rejected and the author has been notified',
    'rejected_notification_failed' => 'Course rejected, but the notification could not be sent',
    'created_add_sections' => 'Course created successfully. You can now add sections',
    'create_failed' => 'Failed to create the course',
    'updated' => 'Course updated successfully',
    'update_failed' => 'Failed to update the course',
    'deleted' => 'Course deleted successfully',
    'delete_failed' => 'Failed to delete the course',
    'not_completable' => 'Course is incomplete. Please add sections, lessons and steps before publishing',
  ],

  'locale' => [
    'invalid' => 'Invalid language',
  ],

  'review' => [
    'status_updated' => 'Review status updated successfully',
    'update_failed' => 'Failed to update the review',
    'deleted' => 'Review deleted successfully',
    'delete_failed' => 'Failed to delete the review',
    'submitted' => 'Your review has been submitted and is awaiting approval',
    'deleted_own' => 'Your review and rating has been deleted',
  ],

  'generic' => [
    'no_changes' => 'No changes were applied',
  ],

  'user' => [
    'status_updated' => 'User status updated successfully',
    'status_update_failed' => 'Failed to update user status',
    'role_updated' => 'User role updated to :role',
    'role_update_failed' => 'Failed to update user role',
    'cannot_delete_self' => 'You cannot delete your own account',
    'cannot_delete_admin' => 'You cannot delete another admin',
    'deleted' => 'User deleted successfully',
    'delete_failed' => 'Failed to delete user',
  ],

  'lesson' => [
    'created' => 'Lesson created successfully',
    'deleted' => 'Lesson deleted successfully',
    'delete_failed' => 'Failed to delete lesson. Please try again',
    'reorder_failed' => 'Failed to reorder lessons. Please try again',
  ],

  'section' => [
    'created' => 'Section created successfully',
    'deleted' => 'Section deleted successfully',
    'delete_failed' => 'Failed to delete section. Please try again',
    'reorder_failed' => 'Failed to reorder sections. Please try again',
  ],

  'step' => [
    'created' => 'Step created successfully',
    'updated' => 'Step updated successfully',
    'deleted' => 'Step deleted successfully',
    'delete_failed' => 'Failed to delete step. Please try again',
    'options_missing' => 'At least one option must be marked as correct',
    'reorder_failed' => 'Failed to reorder steps. Please try again',
  ],

  'enrollment' => [
    'self_enroll' => 'You cannot enroll into your own course',
    'already_enrolled' => 'You are already enrolled in this course',
    'success' => 'You have successfully enrolled in the course',
  ],
];
