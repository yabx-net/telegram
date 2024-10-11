<?php

namespace Yabx\Telegram\Enum;

enum ChatAction: string {
    case Typing = 'typing';
    case RecordVideo = 'record_video';
    case UploadPhoto = 'upload_photo';
    case UploadVideo = 'upload_video';
    case RecordVoice = 'record_voice';
    case UploadVoice = 'upload_voice';
    case UploadDocument = 'upload_document';
    case ChooseSticker = 'choose_sticker';
    case FindLocation = 'find_location';
    case RecordVideoNote = 'record_video_note';
    case UploadVideoNote = 'upload_video_note';
}
