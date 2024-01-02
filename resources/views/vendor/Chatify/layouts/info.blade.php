<style>
    .btn-custom {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 8px 16px;
  background-color: white;
  border: 1px solid #EF4444;
  border-radius: 4px;
  font-weight: 600;
  font-size: 12px;
  color: #EF4444;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05), 0 1px 3px 1px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out, color 0.3s ease-in-out;
}

.btn-custom:hover {
  background-color: #FECDD3;
  border-color: #FECDD3;
  color: #9F1D29;
}

.btn-custom:focus {
  outline: none;
  box-shadow: 0 0 0 2px rgb(147 51 234);;
}

.btn-custom:disabled {
  opacity: 0.25;
  pointer-events: none;
}


      h3 {
        color: rgb(147 51 234);; /* Color for dark mode */
      }
     


</style>
{{-- user info and avatar --}}
<div class="avatar av-l chatify-d-flex"></div>
<p class="info-name">{{ config('chatify.name') }}</p>

{{-- <div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation btn-custom btn-custom:hover btn-custom:focus btn-custom:disabled">Delete Conversation</a>
</div> --}}

{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Shared Photos</span></p>
    <div class="shared-photos-list"></div>
</div>