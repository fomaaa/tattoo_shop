export default function initDadata(item) {
  $(item).suggestions({
    token: '4ac3bf29befb6e4ba3876af3632df6eb29782523',
    bounds: $(item).data('type'),
    type: 'ADDRESS',
    count: $(item).data('count') || 5
  });
}
